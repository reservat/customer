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

## Repository

The repository allows us to retrieve data stored in our persistent storage. We abide to two methods, `getById` and `getAll`.

First off, create an instance of repo.

```
$repo = \Reservat\Repository\CustomerRepository($pdo);
```

Grab all the records (default limit: 20)

```
$customers = $repo->getAll();
```

This will return an instance of `\Reservat\Repository\CustomerRepository`, but implements the Iterator interface, so you can foreach over this object.

```
foreach($customers as $customer) {
    $forename = $customer['forename'];
    ...
}
```

To get a single object, simply call the `getById` method, passing the ID of the record.

```
$customer = $repo->getById(1)->current();
```

`getById` also returns an instance of `\Reservat\Repository\CustomerRepository`.

Using current will either return NULL (if the record is not found) or an array of the customer data.



###@todo

- <del>Implement CustomerRepository</del>
- <del>Add tests</del>
- Include RESTful API endpoints
