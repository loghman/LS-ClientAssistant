# Common method

Most of the utilities has three method including ``get``, ``list``, ``search`` that you can use statically

### get

The get method is for fetch a single item, take a look at the example below

Parameters:

1. id or slug
2. with (this parameter is when you want someting that is related to it, like you want to have prodcut and the creator data then you pass like this: ['user'])

```php
LMSProduct::get(1, ['user']);
```

### list

To get the list of someting you can just easily call list method, list method comes with four optional paramaters:

Paramters:

1. with
2. keyValues (for filtering)
3. perPage (for pagination, the defualt number is 20 and it means 20 items per page)
4. orderBy (you can set an order for returned collection which the default is ``OrderByEnum::LATEST``)

```php
LMSProduct::list();
```

### search

To search items you can use search method statically and it comes with four arguments which are optional.

Parameters:

1. keyword (the keyword you wanna search for)
2. columns (the columns name you want to be returned)
3. with
4. perPage

```php
LMSProduct::search()
```

### queryParams

Some of utilities has a method called ``queryParams`` that is used to handle the parameters that are passed by url query params which can be accessible with $_GET in php.

Parameters:

1. params
2. with
3. perPage

```php
LMSProduct::queryParams()
```


### Return type of methods

all the result from utilites are type of ``Collection`` that comes with some useful feature that you can use in your projects. To get more information about collections click on the link below.

[Laravel collections](https://laravel.com/docs/10.x/collections)

# User





# Enrollments

### Logs

To get the logs of a enrollment to just can easily call the ``logs`` method statically. The logs include all the information about every single session that user has viewed or played.

First of all you need to ``use`` the Enrollment class in first line of your code.

```php
use Ls\ClientAssistant\Utilities\Modules\Enrollment;
```

By just using the code below you can get all the logs of an enrollment.

Paramters:

1. enrollment id
2. user token

```php
Enrollment::logs(4, $userToken);
```

### Signal

Signals are a comment pattern in this framework that you can do some little action, for example, you can signal the action that user just played a video or viewed the session page.
In order to that you can use the sample code below.

Parameters:

1. enrollment id
2. product id
3. type (visited, played, completed)
4. user token

```php
Enrollment::signal(1, 1, 'visited', $userToken);
```
