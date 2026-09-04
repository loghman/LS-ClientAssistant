# زیرساخت Action Dispatcher

## معرفی

این زیرساخت به شما امکان می‌دهد که برای هر Entity (مثل Post، User، Comment و...) یک Handler تعریف کنید و از Controller ها به راحتی آن‌ها را فراخوانی کنید.

## مزایا

- ✅ **جداسازی منطق**: منطق هر Entity در Handler خودش قرار دارد
- ✅ **قابلیت Async**: می‌توانید اجرای برخی عملیات را به صورت غیرهمزمان انجام دهید تا روی لود صفحه تأثیر نگذارد
- ✅ **استفاده آسان**: با Trait یا Helper Functions به راحتی قابل استفاده است
- ✅ **قابل گسترش**: به راحتی Handler های جدید اضافه کنید

---

## شروع سریع

### ۱. ساخت Handler

یک کلاس بسازید که از `BaseEntityHandler` ارث‌بری کند:

```php
<?php

namespace App\Handlers;

use Ls\ClientAssistant\Core\Enums\ActionType;
use Ls\ClientAssistant\Handlers\BaseEntityHandler;

class PostHandler extends BaseEntityHandler
{
    public function getEntity(): string
    {
        return 'post';
    }

    protected function onIndex(array $params): mixed
    {
        // لیست پست‌ها را برگردان
        return ['posts' => $this->fetchPosts($params)];
    }

    protected function onShow(array $params): mixed
    {
        // یک پست را برگردان
        return ['post' => $this->fetchPost($params['id'])];
    }
}
```

### ۲. ثبت Handler

Handler را در Registry ثبت کنید:

```php
use Ls\ClientAssistant\Core\ActionRegistry;
use App\Handlers\PostHandler;

ActionRegistry::getInstance()->register(new PostHandler());
```

### ۳. استفاده در Controller

**روش اول: با Trait (پیشنهادی)**

```php
<?php

namespace App\Controllers;

use Ls\ClientAssistant\Traits\DispatchesActions;

class PostController
{
    use DispatchesActions;

    public function index()
    {
        $result = $this->dispatchIndex('post', ['per_page' => 15]);
        
        return view('posts.index', $result);
    }

    public function show($id)
    {
        $result = $this->dispatchShow('post', ['id' => $id]);
        
        return view('posts.show', $result);
    }
}
```

**روش دوم: با Helper Functions**

```php
public function index()
{
    $result = action_dispatch('post', 'index', ['per_page' => 15]);
    
    return view('posts.index', $result);
}
```

---

## اجرای Async (غیرهمزمان)

برای عملیاتی که نباید لود صفحه را block کنند:

### تنظیم در Handler

```php
class PostHandler extends BaseEntityHandler
{
    protected array $asyncActions = [
        'index' => false,   // همزمان - با لود صفحه اجرا می‌شود
        'show' => false,    // همزمان
        'store' => true,    // غیرهمزمان - صفحه را block نمی‌کند
        'update' => true,   // غیرهمزمان
        'destroy' => true,  // غیرهمزمان
    ];
    
    // ...
}
```

### فراخوانی Async

```php
// روش ۱: Handler تصمیم می‌گیرد (بر اساس $asyncActions)
$result = $this->dispatchStore('post', $data);

// روش ۲: مستقیم async فراخوانی کن (صرف نظر از تنظیمات)
$result = $this->dispatchActionAsync('post', 'store', $data);

// روش ۳: با helper
$result = action_dispatch_async('post', 'store', $data);
```

---

## انواع Action

| Action | متد Handler | توضیح |
|--------|-------------|-------|
| `index` | `onIndex()` | لیست موجودیت‌ها |
| `show` | `onShow()` | نمایش یک موجودیت |
| `create` | `onCreate()` | فرم ساخت |
| `store` | `onStore()` | ذخیره موجودیت جدید |
| `edit` | `onEdit()` | فرم ویرایش |
| `update` | `onUpdate()` | بروزرسانی موجودیت |
| `delete` | `onDelete()` | تأیید حذف |
| `destroy` | `onDestroy()` | حذف واقعی |

---

## بررسی وجود Handler

قبل از dispatch می‌توانید بررسی کنید:

```php
// آیا handler برای این entity وجود دارد؟
if ($this->canDispatch('post', 'index')) {
    $result = $this->dispatchIndex('post');
}

// یا با helper
if (action_can_handle('post', 'index')) {
    $result = action_dispatch('post', 'index');
}
```

---

## مثال کامل

```php
// Handler
class UserHandler extends BaseEntityHandler
{
    protected array $asyncActions = [
        'store' => true,
        'update' => true,
    ];

    public function getEntity(): string
    {
        return 'user';
    }

    public function getSupportedActions(): array
    {
        return [
            ActionType::INDEX,
            ActionType::SHOW,
            ActionType::STORE,
            ActionType::UPDATE,
        ];
    }

    protected function onIndex(array $params): mixed
    {
        return User::paginate($params['per_page'] ?? 15);
    }

    protected function onShow(array $params): mixed
    {
        return User::find($params['id']);
    }

    protected function onStore(array $params): mixed
    {
        return User::create($params);
    }

    protected function onUpdate(array $params): mixed
    {
        $user = User::find($params['id']);
        $user->update($params);
        return $user;
    }
}

// Controller
class UserController
{
    use DispatchesActions;

    public function index()
    {
        return $this->dispatchIndex('user');
    }

    public function store(Request $request)
    {
        // این async اجرا می‌شود
        return $this->dispatchStore('user', $request->all());
    }
}
```
