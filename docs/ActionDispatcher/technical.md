# مستندات فنی Action Dispatcher

## معماری کلی

```
┌─────────────────┐
│   Controller    │
│  (با Trait یا   │
│   Helper)       │
└────────┬────────┘
         │ dispatch('post', 'index')
         ▼
┌─────────────────┐
│ ActionDispatcher│  ← Singleton
│                 │
└────────┬────────┘
         │ get handler
         ▼
┌─────────────────┐
│ ActionRegistry  │  ← نگهداری handlers
│                 │
└────────┬────────┘
         │ return handler
         ▼
┌─────────────────┐
│ EntityHandler   │  ← PostHandler, UserHandler, ...
│ (BaseEntity     │
│  Handler)       │
└────────┬────────┘
         │ execute action
         ▼
    ┌─────────┐
    │ Result  │
    └─────────┘
```

---

## کامپوننت‌ها

### ۱. ActionType Enum

**مسیر:** `sdk/Core/Enums/ActionType.php`

یک PHP 8.1 Enum که انواع action ها را تعریف می‌کند:

```php
enum ActionType: string
{
    case INDEX = 'index';
    case SHOW = 'show';
    case CREATE = 'create';
    case STORE = 'store';
    case EDIT = 'edit';
    case UPDATE = 'update';
    case DELETE = 'delete';
    case DESTROY = 'destroy';
}
```

**چرا Enum؟**
- Type safety در compile time
- IDE autocomplete
- جلوگیری از typo در نام action ها

---

### ۲. EntityHandlerInterface

**مسیر:** `sdk/Core/Contracts/EntityHandlerInterface.php`

Interface اصلی که همه Handler ها باید implement کنند:

```php
interface EntityHandlerInterface
{
    public function getEntity(): string;
    public function getSupportedActions(): array;
    public function supports(ActionType $action): bool;
    public function handle(ActionType $action, array $params, array $options): mixed;
    public function isAsync(ActionType $action): bool;
}
```

| متد | توضیح |
|-----|-------|
| `getEntity()` | نام entity را برمی‌گرداند (مثل 'post') |
| `getSupportedActions()` | لیست action های پشتیبانی شده |
| `supports()` | آیا یک action خاص پشتیبانی می‌شود؟ |
| `handle()` | اجرای action |
| `isAsync()` | آیا action باید async اجرا شود؟ |

---

### ۳. BaseEntityHandler

**مسیر:** `sdk/Handlers/BaseEntityHandler.php`

کلاس abstract که پیاده‌سازی پیش‌فرض Interface را ارائه می‌دهد:

```php
abstract class BaseEntityHandler implements EntityHandlerInterface
{
    protected array $asyncActions = [];
    protected bool $defaultAsync = false;

    abstract public function getEntity(): string;

    public function handle(ActionType $action, array $params, array $options): mixed
    {
        $methodName = $this->getMethodName($action);  // 'index' → 'onIndex'
        
        $runAsync = $options['async'] ?? $this->isAsync($action);

        if ($runAsync) {
            return $this->executeAsync($methodName, $params);
        }

        return $this->$methodName($params);
    }

    protected function getMethodName(ActionType $action): string
    {
        return 'on' . ucfirst($action->value);  // 'index' → 'onIndex'
    }
}
```

**Convention برای نام متدها:**

| Action | Method Name |
|--------|-------------|
| `index` | `onIndex()` |
| `show` | `onShow()` |
| `store` | `onStore()` |
| ... | ... |

**چرا این convention؟**
- نام‌گذاری یکنواخت
- استفاده از `method_exists()` برای بررسی پشتیبانی
- خوانایی بهتر کد

---

### ۴. ActionRegistry

**مسیر:** `sdk/Core/ActionRegistry.php`

مخزن نگهداری Handler ها با الگوی Singleton:

```php
class ActionRegistry
{
    private array $handlers = [];  // ['post' => PostHandler, 'user' => UserHandler]
    private static ?ActionRegistry $instance = null;

    public static function getInstance(): ActionRegistry { ... }

    public function register(EntityHandlerInterface $handler): static
    {
        $entity = strtolower($handler->getEntity());
        $this->handlers[$entity] = $handler;
        return $this;
    }

    public function get(string $entity): ?EntityHandlerInterface
    {
        return $this->handlers[strtolower($entity)] ?? null;
    }

    public function has(string $entity): bool { ... }
    public function hasAction(string $entity, ActionType $action): bool { ... }
}
```

**چرا Singleton؟**
- یک Registry مرکزی برای کل application
- دسترسی آسان از هر جای کد
- جلوگیری از duplicate registration

---

### ۵. ActionDispatcher

**مسیر:** `sdk/Core/ActionDispatcher.php`

کلاس اصلی برای dispatch کردن action ها:

```php
class ActionDispatcher
{
    private ActionRegistry $registry;
    private static ?ActionDispatcher $instance = null;

    public function dispatch(
        string $entity, 
        ActionType|string $action, 
        array $params = [], 
        array $options = []
    ): mixed {
        // 1. Convert string to ActionType if needed
        if (is_string($action)) {
            $action = ActionType::from(strtolower($action));
        }

        // 2. Check if handler exists
        if (!$this->registry->has($entity)) {
            return null;
        }

        // 3. Get handler
        $handler = $this->registry->get($entity);

        // 4. Check if action is supported
        if (!$handler->supports($action)) {
            return null;
        }

        // 5. Execute
        return $handler->handle($action, $params, $options);
    }
}
```

**Flow:**
1. تبدیل string به ActionType (اگر نیاز باشد)
2. بررسی وجود handler
3. دریافت handler
4. بررسی پشتیبانی از action
5. اجرا

---

### ۶. DispatchesActions Trait

**مسیر:** `sdk/Traits/DispatchesActions.php`

Trait برای استفاده آسان در Controller ها:

```php
trait DispatchesActions
{
    protected function getDispatcher(): ActionDispatcher
    {
        return ActionDispatcher::getInstance();
    }

    protected function dispatchAction(string $entity, ActionType|string $action, ...): mixed
    {
        return $this->getDispatcher()->dispatch($entity, $action, ...);
    }

    // Shortcut methods
    protected function dispatchIndex(string $entity, ...): mixed { ... }
    protected function dispatchShow(string $entity, ...): mixed { ... }
    // ...
}
```

---

## اجرای Async

### مکانیزم

```php
protected function executeAsync(string $method, array $params): mixed
{
    register_shutdown_function(function () use ($method, $params) {
        ignore_user_abort(true);
        
        if (function_exists('fastcgi_finish_request')) {
            fastcgi_finish_request();
        }

        $this->$method($params);
    });

    return ['status' => 'queued', 'async' => true];
}
```

**چگونه کار می‌کند:**

1. `register_shutdown_function()`: کد را برای اجرا بعد از پایان script ثبت می‌کند
2. `ignore_user_abort(true)`: حتی اگر کاربر connection را ببندد، اجرا ادامه می‌یابد
3. `fastcgi_finish_request()`: خروجی را به کاربر می‌فرستد و connection را می‌بندد، اما PHP ادامه می‌دهد

**نتیجه:**
- کاربر بلافاصله response می‌گیرد
- کار سنگین در background انجام می‌شود
- لود صفحه block نمی‌شود

---

## Helper Functions

**مسیر:** `framework_helpers.php`

```php
function action_dispatch(string $entity, $action, array $params = [], array $options = []): mixed
{
    return ActionDispatcher::getInstance()->dispatch($entity, $action, $params, $options);
}

function action_dispatch_async(string $entity, $action, array $params = []): mixed
{
    return ActionDispatcher::getInstance()->dispatchAsync($entity, $action, $params);
}

function action_can_handle(string $entity, $action): bool
{
    return ActionDispatcher::getInstance()->canHandle($entity, $action);
}

function action_registry(): ActionRegistry
{
    return ActionRegistry::getInstance();
}

function action_dispatcher(): ActionDispatcher
{
    return ActionDispatcher::getInstance();
}
```

---

## Sequence Diagram

```
Controller          Dispatcher          Registry           Handler
    │                   │                   │                  │
    │ dispatchIndex     │                   │                  │
    │──────────────────>│                   │                  │
    │                   │                   │                  │
    │                   │ has('post')       │                  │
    │                   │──────────────────>│                  │
    │                   │                   │                  │
    │                   │ true              │                  │
    │                   │<──────────────────│                  │
    │                   │                   │                  │
    │                   │ get('post')       │                  │
    │                   │──────────────────>│                  │
    │                   │                   │                  │
    │                   │ PostHandler       │                  │
    │                   │<──────────────────│                  │
    │                   │                   │                  │
    │                   │ supports(INDEX)                      │
    │                   │─────────────────────────────────────>│
    │                   │                                      │
    │                   │ true                                 │
    │                   │<─────────────────────────────────────│
    │                   │                                      │
    │                   │ handle(INDEX, params)                │
    │                   │─────────────────────────────────────>│
    │                   │                                      │
    │                   │                        onIndex()     │
    │                   │                              │       │
    │                   │                              ▼       │
    │                   │                         [Execute]    │
    │                   │                                      │
    │                   │ result                               │
    │                   │<─────────────────────────────────────│
    │                   │                                      │
    │ result            │                                      │
    │<──────────────────│                                      │
```

---

## نکات مهم

### Thread Safety
- Registry و Dispatcher از Singleton pattern استفاده می‌کنند
- در PHP (بدون threading) این مشکلی ایجاد نمی‌کند
- هر request یک instance جداگانه دارد

### Performance
- Handler ها lazy load نیستند - باید در startup ثبت شوند
- برای performance بهتر، می‌توانید handlers را cache کنید

### Error Handling
- اگر handler وجود نداشته باشد، `null` برگردانده می‌شود
- اگر action پشتیبانی نشود، `null` برگردانده می‌شود
- Exception ها به caller propagate می‌شوند

### Testing
```php
// Mock کردن registry
$registry = new ActionRegistry();
$registry->register(new MockPostHandler());

$dispatcher = new ActionDispatcher($registry);
$result = $dispatcher->dispatch('post', 'index');

// Assert...
```
