# simple roles-permission management for laravel   
> Install plugin via command 
```
composer require nagarjunbn/acl
```
> Register the service provider in ```app.php```
```
Nagarjun\ACL\ACLServiceProvider::class
```
> Migrate the new tables
> Update your Users table and add ```'role_id'``` column 
> Add the below code to your User.php model file
```
public function Role() {
    return $this->belongsTo('\Nagarjun\ACL\Models\Role', 'role_id', 'id');
}
``` 
> Make sure your application environment is local i.e., ```APP_ENV=local``` . The ACL urls are blocked if the application is not in local mode to avoid misuse of the plugin . 
> Access the plugin via URL and set permissions
```
http://domain/acl/dashboard
```
> Use the middleware ```'acl'``` in your routes,controllers to prevent the access.
