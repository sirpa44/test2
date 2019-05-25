# Test2


### Install the app
clone the git repo on your own host

```bash
$ git clone https://github.com/sirpa44/test2.git
```

dependency
```bash
$ composer update
```

database mysql
```bash
$ bin/console doctrine:database:create
$ bin/console doctrine:schema:create
```

mysql
create .env.local file
```yaml
DATABASE_URL=mysql://username:password@127.0.0.1:3306/DBname
```

import data from csv file 
```yaml
$ bin/console app:import-csv
```

###Requests

make your request as exemple

```
http://yourHost?request=findAll
```

####Find one user

######variables required:

request=findOne&username=name


####Find all user

######variables required:

request=findAll

####Create user

######variables required:

request=create&username=name

####Update user

######variable required:

request=update&username=name

######optional variables:

btc=float

xrp=float

ltc=float

eth=float