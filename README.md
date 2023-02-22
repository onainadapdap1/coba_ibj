# Go Shop
Laravel rest api for Brief Technical Test Back-End Developer Intern 
## How to run
### Required
- MySql
- PHP (v8.1.11)

### Run
```
$ php artisan serve
```

### Using Postman for testing
``` 
1. Admin (First, create admin account)
    - register-admin
    - login-admin
    - get-admin
    - admin-logout

2. Course Category (Second, create course category CRUD by login using admin account)
    - create course category
    - update course category
    - destroy course category
    - restore course category
    - get all course category
    - get one course category

3. Course (Third, create Course CRUD by login using admin account)
    - create course
    - update course
    - destroy course
    - restore course
    - get all course
    - get one course

4. User (Fourth, create user account)
    - register
    - login
    - getuser
    - logout

5. User Course (Fifth, create user course CRUD by login using user account)
    - create user course
    - update user course
    - destroy user course 
    - show all course current user
```

### URL Postman
```
- Url Postman Link : https://documenter.getpostman.com/view/20268960/2s93CLtENM
```

Project information and existing API
``` 
+--------+----------+--------------------------------+---------------+----------------------------------------------------------------+-------------------------------------------------+
| Domain | Method   | URI                            | Name          | Action                                                         | Middleware                                      |
+--------+----------+--------------------------------+---------------+----------------------------------------------------------------+-------------------------------------------------+
|        | POST     | api/adminLogin                 | adminLogin    | App\Http\Controllers\AdminController@adminLogin                | api                                             |
|        | POST     | api/adminLogout                | adminLogout   | App\Http\Controllers\AdminController@adminLogout               | api                                             |
|        |          |                                |               |                                                                | App\Http\Middleware\AuthenticateAdmin:admin-api |
|        | POST     | api/adminRegister              | adminRegister | App\Http\Controllers\AdminController@adminRegister             | api                                             |
|        | POST     | api/createcourse               |               | App\Http\Controllers\CourseController@createCourse             | api                                             |
|        |          |                                |               |                                                                | App\Http\Middleware\AuthenticateAdmin:admin-api |
|        | POST     | api/createcoursecategory       |               | App\Http\Controllers\CourseCategoryController@createCategory   | api                                             |
|        |          |                                |               |                                                                | App\Http\Middleware\AuthenticateAdmin:admin-api |
|        | POST     | api/createusercourse           |               | App\Http\Controllers\UserCourseController@createUserCourse     | api                                             |
|        | POST     | api/deleteusercourse/{id}      |               | App\Http\Controllers\UserCourseController@destroyUserCourse    | api                                             |
|        | POST     | api/destroycourse/{id}         |               | App\Http\Controllers\CourseController@destroyCourse            | api                                             |
|        |          |                                |               |                                                                | App\Http\Middleware\AuthenticateAdmin:admin-api |
|        | POST     | api/destroycoursecategory/{id} |               | App\Http\Controllers\CourseCategoryController@destroycategory  | api                                             |
|        |          |                                |               |                                                                | App\Http\Middleware\AuthenticateAdmin:admin-api |
|        | GET|HEAD | api/getallcategories           |               | App\Http\Controllers\CourseCategoryController@getAllCategories | api                                             |
|        |          |                                |               |                                                                | App\Http\Middleware\AuthenticateAdmin:admin-api |
|        | GET|HEAD | api/getallcourse               |               | App\Http\Controllers\CourseController@getAllCourse             | api                                             |
|        |          |                                |               |                                                                | App\Http\Middleware\AuthenticateAdmin:admin-api |
|        | GET|HEAD | api/getonecategory/{id}        |               | App\Http\Controllers\CourseCategoryController@getOneCategory   | api                                             |
|        |          |                                |               |                                                                | App\Http\Middleware\AuthenticateAdmin:admin-api |
|        | GET|HEAD | api/getonecourse/{id}          |               | App\Http\Controllers\CourseController@getOneCourse             | api                                             |
|        |          |                                |               |                                                                | App\Http\Middleware\AuthenticateAdmin:admin-api |
|        | GET|HEAD | api/me                         |               | App\Http\Controllers\AdminController@me                        | api                                             |
|        |          |                                |               |                                                                | App\Http\Middleware\AuthenticateAdmin:admin-api |
|        | GET|HEAD | api/meuser                     |               | App\Http\Controllers\UserController@me                         | api                                             |
|        | POST     | api/restorecourse/{id}         |               | App\Http\Controllers\CourseController@restoreCourse            | api                                             |
|        |          |                                |               |                                                                | App\Http\Middleware\AuthenticateAdmin:admin-api |
|        | POST     | api/restorecoursecategory/{id} |               | App\Http\Controllers\CourseCategoryController@restorecategory  | api                                             |
|        |          |                                |               |                                                                | App\Http\Middleware\AuthenticateAdmin:admin-api |
|        | GET|HEAD | api/showusercourse             |               | App\Http\Controllers\UserCourseController@showUserCourse       | api                                             |
|        | POST     | api/updatecourse/{id}          |               | App\Http\Controllers\CourseController@updateCourse             | api                                             |
|        |          |                                |               |                                                                | App\Http\Middleware\AuthenticateAdmin:admin-api |
|        | POST     | api/updatecoursecategory/{id}  |               | App\Http\Controllers\CourseCategoryController@updateCategory   | api                                             |
|        |          |                                |               |                                                                | App\Http\Middleware\AuthenticateAdmin:admin-api |
|        | POST     | api/updateusercourse/{id}      |               | App\Http\Controllers\UserCourseController@updateUserCourse     | api                                             |
|        | POST     | api/userLogin                  | userLogin     | App\Http\Controllers\UserController@userLogin                  | api                                             |
|        | POST     | api/userLogout                 | userLogout    | App\Http\Controllers\UserController@userLogout                 | api                                             |
|        | POST     | api/userRegister               | userRegister  | App\Http\Controllers\UserController@userRegister               | api                                             |
+--------+----------+--------------------------------+---------------+----------------------------------------------------------------+-------------------------------------------------+
```



### Techstack
- RESTful API
- Laravel
- jwt-auth
