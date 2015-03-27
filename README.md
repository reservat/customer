# Reservat\Customer

Customer component service for Reservat application.

## Basic Usage

Create a new customer object

```
$customer = new \Reservat\Customer('Luke', 'Steadman', '01234567890', 'luke@steadman.com');
```

Create an instance of `\Reservat\Datamapper\CustomerDatamapper`

```
// We assume $pdo is stored elsewhere and shared
$mapper = new \Reservat\Datamapper\CustomerDatamapper($pdo);
```

Now save your customer

```
$mapper->save($customer);
```

###@todo

- Implement CustomerRepository
- Add tests
- Include RESTful API endpoints
