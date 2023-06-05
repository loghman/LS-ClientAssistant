### User Token
Every method may requires you to pass a token for user and it is for recognizing the user in order to know which user we are working for.


### Enrollments


## Logs
To get the logs of a enrollment to just can easily call the ``logs`` method statically. The logs include all the information about every single session that user has viewed or played.

First of all you need to ``use`` the Enrollment class in first line of your code.
```php
use Ls\ClientAssistant\Utilities\Modules\Enrollment;
```
By just using the code below you can get all the logs of an enrollment
```php
Enrollment::logs(4, $userToken)
```

## Signal
Signals are a comment pattern in this framework that you can do some little action, for example, you can signal the action that user just played a video or viewed the session page.
In order to that you can use the sample code below.

Parameters:


```php
Enrollment::signal(1, 1, 'visited', $userToken)
```
