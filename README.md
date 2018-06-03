# Ocean Eye Application

Web Application backend / shell for the implementation of the Ocean Eye Model

### clone it

```bash
git clone https://github.com/mondial7/ocean-eye-app.git
cd ocean-eye-app/
```

### DB config

```bash
cd ../configs/
touch EKEDB_config.php
```

Example of EKEDB_config:

```php
<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'knopfy');
define('DB_PASSWORD', 'ocean');
define('DB_DATABASE', 'oceaneye');
```

### Deploy


### Infinite backlog

- [x] Polymer Template/View integration
- [ ] DB dump
- [ ] API docs
- [ ] PHPUnit tests for application core
- [ ] Codeception tests - [codeception.com](https://codeception.com/)
- [ ] Multiple DB engines support
