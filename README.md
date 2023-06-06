* [Common methods](#common-methods)

  * [get](#get)
  * [list](#list)
  * [search](#search)
  * [queryParams](#queryparams)
  * [return type of methods](#return-type-of-methods)
* [Authentication](#authentication)

  * [password based](#password-based)
    * [login](#login)
    * [register](#register)
    * [verifyVerificationCode](#verifyverificationcode)
    * [sendVerificationCode](#sendverificationcode)
  * [two fa based](#two-fa-based)
    * [login](#login-1)
    * [verifyVerificationCode](#verifyverificationcode-1)
    * [sendVerificationCode](#sendverificationcode-1)
    * [logout](#logout)
* [User](#user)

  * [me](#me)
  * [loggedIn](#loggedin)
  * [logout](#logout-1)
  * [updateUserInfo](#updateUserInfo)
  * [courses](#courses)
  * [stats](#stats)
  * [uploadResumeBanner](#uploadresumebanner)
  * [updatePassword](#updatepassword)
  * [uploadProfileImage](#uploadprofileimage)
  * [Update user mobile](#update-user-mobile)
* [CMS](#cms)

  * [signal](#signal)
* [Cart](#cart)
* [Chapter enrollment](#chapter-enrollment)
* [Comments](#comments)

  * [Comments of a product](#comments-of-a-product)
  * [Comments of a post](#comments-of-a-post)
  * [Comments of a shop](#comments-of-a-shop-product)
* [Coupon](#coupon)
* [Enrollments](#enrollments)

  * [logs](#logs)
  * [signal](#signal)
* [Gift](#gift)
* [LMSProduct](#lmsproduct)

  * [chapters](#chapters)
  * [chapterStats](#chapterstats)
  * [nextItem](#nextitem)
  * [prevItem](#previtem)
  * [nextChapter](#nextchapter)
  * [prevChapter](#prevchapter)
  * [faculty](#faculty)
  * [demo](#demo)
  * [createTopic](#createtopic)
* [QC](#qc)

  * [addReview](#addreview)
* [Support](#support)

  * [Community](#community)
    * [list](#list-1)
    * [stats](#stats-1)
  * [Topic](#topic)
  * [Reply](#reply)
    * [reply](#reply-1)
    * [update](#update)
    * [like](#like)
    * [delete](#delete)
* [Survey](#survey)
* [Term](#term)
* [Tools](#tools)

  * [Datetime](#datetime)
  * [IP](#ip)
  * [Lang](#lang)
  * [Price](#price)



# Common methods

Most of the utilities has three method including ``get``, ``list``, ``search`` that you can use statically

### get

The get method is for fetch a single item, take a look at the example below

Parameters:

1. id or slug
2. with (optional - this parameter is when you want someting that is related to it, like you want to have prodcut and the creator data then you pass like this: ['user'])

```php
LMSProduct::get(1, ['user']);
```

### list

To get the list of someting you can just easily call list method, list method comes with four optional paramaters:

Paramters:

1. with (optional)
2. keyValues (optional - for filtering)
3. perPage (optional - for pagination, the defualt number is 20 and it means 20 items per page)
4. orderBy (optional - you can set an order for returned collection which the default is ``OrderByEnum::LATEST``)

```php
LMSProduct::list();
```

### search

To search items you can use search method statically and it comes with four arguments which are optional.

Parameters:

1. keyword (optional - the keyword you wanna search for)
2. columns (optional - the columns name you want to be returned)
3. with (optional)
4. perPage (optional)

```php
LMSProduct::search();
```

### queryParams

Some of utilities has a method called ``queryParams`` that is used to handle the parameters that are passed by url query params which can be accessible with $_GET in php.

Parameters:

1. params
2. with
3. perPage

```php
LMSProduct::queryParams();
```

### Return type of methods

all the result from utilites are type of ``Collection`` that comes with some useful feature that you can use in your projects. To get more information about collections click on the link below.

[Laravel collections](https://laravel.com/docs/10.x/collections)

# Authentication

There are two different authentication method you can use that are ``PasswordBasedAuth`` and ``TwoFaBasedAuth``.

When user is successfully loggeed in or registered a token will be returned that you can store that token in user browser cookies to keep the user logged in.

## Password based

### Login

To login with your (mobile, email) and password.

```php
PasswordBasedAuth::login($mobileOrEmail, $password);
```

If user already exists a token will be returned as result.

### Register

To register you need to pass the parameters below:

1. mobileOrEmail
2. password
3. password confirmation

```php
PasswordBasedAuth::register($mobileOrEmail, $password, $passwordConfirmation);
```

After calling the ``register`` method a otp will be sent to the user and you have to verify it.

### verifyVerificationCode

To verify otp.

Parameters:

1. mobileOrEmail
2. otp

```php
PasswordBasedAuth::verifyVerificationCode($mobileOrEmail, $otp);
```

If the otp is valid a token will be returned.

### sendVerificationCode

To send an otp again.

```php
PasswordBasedAuth::sendVerificationCode($mobileOrEmail);
```

## Two fa based

### login

To login or register.

```php
TwoFaBasedAuth::login($mobileOrEmail);
```

An otp will be sent to the user then user has to verify it in order to get the token to be logged in.

### verifyVerificationCode

```php
TwoFaBasedAuth::verifyVerificationCode($mobileOrEmail, $otp);
```

If the otp is valid then a token will be returned as result.

### sendVerificationCode

To an otp again

```php
TwoFaBasedAuth::sendVerificationCode($mobileOrEmail);
```

### logout

```php
TwoFaBasedAuth::logout($userToken);
```

## Storing the token in user browser

To store the returned token in authentication scenario, we provide the ``Token`` class.

```php
Token::token($token)->setCookie()->weeks(2);
```

We just stored the token for 2 weeks in user browser, there are also other methods you can use instead of ``weeks`` like ``seconds``, ``minutes``, ``hours``, ``days`` and ``weeks``.

You can also delete the token.

```php
Token::token($token)->remove();
```

Just like that.

# User

### me

To get the all information about a user, you just need to pass the user token to the ``me`` method.

```php
User::me($userToken);
```

### loggedIn

If you want to check if nor user is logged in you just need to call ``loggedIn`` method and pass userToken.

```php
User::loggedIn($userToken);
```

### logout

```php
User::logout($userToken);
```

### updateUserInfo

To update user information like (real_name, display_name, gender, birth_date) you just need to pass mentioned data as an array and userToken as second argument.

```php
User::updateUserInfo($data, $userToken);
```

A real example could be:

```php
User::updateUserInfo([
    'real_name' => 'Amir Salehi',
    'display_name' => 'Amir',
    'gender' => 'male',
    'birth_date' => '2001-09-27',
], $userToken);
```

### courses

To get all the courses that user has purchased.

```php
User::courses($userToken);
```

### stats

Stats include (courses_count, questions_count, comments_count, days_with_platform)

```php
User::stats($userToken);
```

### uploadResumeBanner

To upload user resume's benner.

Paramters:

1. file (uploaded file's response content)
2. userToken
3. title (optional)
4. attachment id (optional - for updating resume banner)

```php
User::uploadResumeBanner($file, $userToken, $title, $attachmentId);
```

### updatePassword

To update user password.

Parameters:

1. current password
2. new password
3. password confirmation
4. user token

```php
User::updatePassword($currentPassword, $newPassword, $passwordConfirmation, $userToken);
```

### uploadProfileImage

To upload profile image

1. file (uploaded file's response content)
2. userToken
3. title (optional)
4. attachment id (optional - for updating user profile image)

```php
User::uploadProfileImage($file, $userToken, $title, $attachmentId);
```

### Update user mobile

In updating user mobile scenario, you first need to send an otp for user and then verify it.

#### sendOtpForMobileNumber

```php
User::sendOtpForMobileNumber($mobile, $userToken);
```

#### verifyCodeForUpdatingMobileNumber

```php
User::verifyCodeForUpdatingMobileNumber($mobile, $otp, $userToken);
```

# CMS

CMS class includes five funtionalities that four of them are type of ``Common methods`` that are explained at first (``get``, ``list``, ``search``).

### Signal

Signal include actions like (visit, like, dislike, rate, bookmark), for example to save a new like for a post you just need to write the code below:

Parameters:

1. post id
2. type (visit, like, dislike, rate, bookmark)
3. value

```php
CMS::signal($postId, 'like', 1);
```

# Cart

Cart includes the ``common methods`` (``get``, ``list``, ``search``). Basically cart is for the shoppng basket in your website.

# Chapter enrollment

User might have enrolled just some chapters that you can get the purchased chapters via this class.

```php
ChapterEnrollment::forUser($userToken);
```

# Comments

### Comments of a product

To get all the comments of a product.

Parameters:

1. Product id
2. perPage (optional - for pagination, the default value is 20)

```php
Comment::getLMSProductComments($productId, $perPage);
```

### Comments of a post

To get all the comments of a post.

Parameters:

1. post id
2. perPage (optional - for pagination, the default value is 20)

```php
Comment::getPostComments($postId, $perPage);
```

### Comments of a shop product

To get all the comments of a shop product.

Parameters:

1. shop id
2. perPage (optional - for pagination, the default value is 20)

```php
Comment::getShopProductComments($shopId, $perPage);
```

# Coupon

Coupon has three ``Commen methods`` that mentioned at first. Basically you can get information about existed coupons in platform by using this class.

# Enrollments

Enrollment has three ``commen methods`` that are mentioned at first (``get``, ``list``, ``search``). but also it comes with two new methods called ``logs`` and ``signal``.

### logs

To get the logs of a enrollment to just can easily call the ``logs`` method statically. The logs include all the information about every single session that user has viewed, played or completed.

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

### signal

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

# Gift

Gift are for gamification section that has three ``Common methods`` that are mentioned at first (``get``, ``list``, ``search``).

# LMS Product

LMS Product comes with a lot of funcationally and some of the are ``Common methods`` that are mentioned at first (``get``, ``list``, ``search``, ``queryParams``).

### chapters

To get all the chapters of a product.

```php
LMSProduct::chapters($productId);
```

### chapterStats

To get the stats about chapters that includes (chapter\_complete\_percentage)

Parameters:

1. product id
2. chapter id
3. user token

```php
LMSProduct::chapterStats($productId, $chapterId, $userToken);
```

### nextItem

To get the next item's data of an item (like a video of a session that user is watching).

```php
LMSProduct::nextItem($productId, $itemId);
```

### prevItem

To get the previous item's data of an item (like a video of a session that user is watching).

```php
LMSProduct::prevItem($productId, $itemId);
```

### nextChapter

To get the next chapter's data.

```php
LMSProduct::nextChapter($productId, $chapterId);
```

### prevChapter

To get the previous chapter's data.

```php
LMSProduct::prevChapter($productId, $chapterId);
```

### faculty

To get all the information about teachers and mentors of an product.

```php
LMSProduct::faculty($productId);
```

### demo

To get the free items of a product which are known for demo.

```php
LMSProduct::demo($productId);
```

### createTopic

To create a topic for an item (session) of a product.

Parameters:

1. data (includes: item_id, title, content, attachment(optional), is_anonymous(optional), section(optional), community(optional), department(optional))
2. userToken

```php
LMSProduct::createTopic([
    'title' => 'How to print a hello world in javascript?',
    'content' => 'The long content of How to print a hello world in javascript?'
], $userToken);
```

# QC

QC consists of three ``common methods`` that are mentioned at first (``get``, ``list``, ``search``).

### addReview

To add a review for a product

Parameters:

1. product id
2. item id
3. rate
4. comment (optional)
5. userToken

```php
QC::addReview([
   'product_id' => 1,
    'item_id' => 1,
    'rate' => 5,
], $userToken);
```

# Support

Support section consists of three sections that are community, topic and reply.

## Community

### list

To get the list of communities.

Parameters:

1. with (optional)
2. keyValue (optional)
3. perPage (optional)
4. orderBy (optional)

```php
SupportCommunity::list();
```

### stats

To get the stats about community like (active\_students, topics\_count, community\_count)

```php
SupportCommunity::stats();
```

## Topic

Topic includes three ``Common methods`` that are mentioned at first (``get``, ``list``, ``search``).

## Reply

### reply

To reply a topic.

Parameters:

1. data (topic_id, content, attachment(optional))
2. userToken

```php
SupportReply::reply([
    'topic_id' => 1,
    'content' => 'this is a reply',
], $userToken);
```

### update

To update a reply.

Parameters:

1. data (topic_id, replye_id, content, attachment(optional))
2. userToken

```php
SupportReply::update([
    'topic_id' => 1,
    'reply_id' => 1,
    'content' => 'this is a reply',
], $userToken);
```

### like

To like a reply.

Parameters:

1. topic id
2. reply id
3. userToken

```php
SupportReply::like($topicId, $replyId, $userToken);
```

### delete

To delete a reply.

Parameters:

1. topic id
2. reply id
3. userToken

```php
SupportReply::delete($topicId, $replyId, $userToken);
```

# Survery

Survery includes three Common methods that are mentioned at first (``get``, ``list``, ``search``).

# Term

Term includes three Common methods that are mentioned at first (``get``, ``list``, ``search``).



# Tools

Some useful tools are implemented to provide you better experience working with this framework

## DateTime

To covert english date time to persian.

```php
DateTime::toPersianDate($enDate);
```

## IP

To get the user IP.

```php
IP::get();
```

To get info about ip

```php
IP::info($ip);
```

## Lang

To convert persian number to english.

```php
Lang::persianNumbers($number);
```

To convert english number to persian.

```php
Lang::latinNumbers($number);
```

## Price

To convert price to persian price.

```php
Price::toPersianPrice($price);
```
