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

## Mapper

DataMapper functionality allows you to save (insert / update) and delete customer records. First off, create a mapper instance.

```
$mapper = new \Reservat\Datamapper\CustomerDatamapper($pdo);
```

Let's create a new customer object and insert this with the mapper

```
$customer = new \Reservat\Customer('Paul', 'Westerdale', '01234567890', 'paul@westerdale.com');
$mapper->insert($customer); // same as $mapper->save($customer);
```

Let's update the customer object. We need to know the ID of the customer which might not be passed back to the customer
entity object, you will have to handle this.

```
$customer->setEmail('paulo@westerdale.com');
$mapper->update($customer, 2);
```

Or use the save function to update the customer

```
$mapper->save($customer, 2);
```

Finally, remove the customer with the mapper

```
$mapper->delete($customer, 2);
```

###@todo

- <del>Implement CustomerRepository</del>
- <del>Add tests</del>
- Include RESTful API endpoints
