# Cities sample RESTful service

Sample application that demonstrates RESTful and admin interface for manage cities. Also there is REST method that
provides checking if some address geo point located in area.

Application made using [Yii2 advanced application template](https://github.com/yiisoft/yii2-app-advanced).

## Running application

Easiest way to run application using vagrant.

1. Install [VirtualBox](https://www.virtualbox.org/wiki/Downloads)
2. Install [Vagrant](https://www.vagrantup.com/downloads.html)
3. Create GitHub [personal API token](https://github.com/blog/1509-personal-api-tokens)
3. Clone project:
   
   ```bash
   git clone https://github.com/denispugachev/cities.git
   cd cities/vagrant/config
   cp vagrant-local.example.yml vagrant-local.yml
   ```
   
4. Place your GitHub personal API token to `vagrant-local.yml`
5. Change directory to project root:

   ```bash
   cd cities
   ```

5. Run commands:

   ```bash
   vagrant plugin install vagrant-hostmanager
   vagrant up
   ``` 
   
## Admin interface

After your vagrant machine is up you can try to log in to admin interface:

[https://cities.dev/admin](https://cities.dev/admin)

Default credentials is `admin` / `admin`.

Here you can manage cities and grab access token for making API requests (access token generates on user creating).

## Cities REST API

Using access token you can try to make some API requests to play with cities data:

[https://cities.dev/api/v1/cities?access-token=xxxxxxxx](https://cities.dev/api/v1/cities?access-token=xxxxxxxx)
 
[https://cities.dev/api/v1/cities/1?access-token=xxxxxxxx](https://cities.dev/api/v1/cities/1?access-token=xxxxxxxx)

Try to make GET, POST, OPTIONS, DELETE, PUT requests.

## Address finder API endpoint

Also there is API endpoint for address geo point checking that will return boolean result depends on distance between
address point and center point.

[GET https://cities.dev/api/v1/address](https://cities.dev/api/v1/address)

Required input GET parameters

| Parameter    | Type   | Description                          |
|--------------|--------|--------------------------------------|
| access-token | string | Your access token                    |
| address      | string | Address to be searched with Geocoder |
| latitude     | float  | Latitude of center point             |
| longitude    | float  | Longitude of center point            |
| distance     | float  | Distance                             |

Response example

```json
{
  "result": true
}
```

If request fails it will return non-200 HTTP status.

## Good testing :)

```
 ▄▄▄▄▄▄▄▄▄▄▄  ▄▄        ▄  ▄▄▄▄▄▄▄▄▄▄▄  ▄▄▄▄▄▄▄▄▄▄▄  ▄         ▄  ▄ 
▐░░░░░░░░░░░▌▐░░▌      ▐░▌▐░░░░░░░░░░░▌▐░░░░░░░░░░░▌▐░▌       ▐░▌▐░▌
▐░█▀▀▀▀▀▀▀▀▀ ▐░▌░▌     ▐░▌ ▀▀▀▀▀█░█▀▀▀ ▐░█▀▀▀▀▀▀▀█░▌▐░▌       ▐░▌▐░▌
▐░▌          ▐░▌▐░▌    ▐░▌      ▐░▌    ▐░▌       ▐░▌▐░▌       ▐░▌▐░▌
▐░█▄▄▄▄▄▄▄▄▄ ▐░▌ ▐░▌   ▐░▌      ▐░▌    ▐░▌       ▐░▌▐░█▄▄▄▄▄▄▄█░▌▐░▌
▐░░░░░░░░░░░▌▐░▌  ▐░▌  ▐░▌      ▐░▌    ▐░▌       ▐░▌▐░░░░░░░░░░░▌▐░▌
▐░█▀▀▀▀▀▀▀▀▀ ▐░▌   ▐░▌ ▐░▌      ▐░▌    ▐░▌       ▐░▌ ▀▀▀▀█░█▀▀▀▀ ▐░▌
▐░▌          ▐░▌    ▐░▌▐░▌      ▐░▌    ▐░▌       ▐░▌     ▐░▌      ▀ 
▐░█▄▄▄▄▄▄▄▄▄ ▐░▌     ▐░▐░▌ ▄▄▄▄▄█░▌    ▐░█▄▄▄▄▄▄▄█░▌     ▐░▌      ▄ 
▐░░░░░░░░░░░▌▐░▌      ▐░░▌▐░░░░░░░▌    ▐░░░░░░░░░░░▌     ▐░▌     ▐░▌
 ▀▀▀▀▀▀▀▀▀▀▀  ▀        ▀▀  ▀▀▀▀▀▀▀      ▀▀▀▀▀▀▀▀▀▀▀       ▀       ▀ 
                                                                    
```