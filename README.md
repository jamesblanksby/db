# DB
A simple PHP MySQLi wrapper

---

## Initialisation
All functions require a MySQLi object created with `mysqli_connect` to be passed.

## Select Query
Returns `data array` on success or **FALSE** if no results are found.
```php
db::select(object $mysqli, string $table_name 
	[, mixed $rows [, array $where = null [, array $order_by = null [, string $limit]]]]);
```
Here is an example:
```php
$user_array = db::select($mysqli, 'user', ['name' => 'John%'], ['name' => 'ASC'], '10');
```

## Insert Query
Returns **TRUE** on success or **FALSE** on failure.
```php
db::insert(object $mysqli, string $table_name, array $data);
```
Here is an example using external variables passed to the query via bind variables:
```php
$data = [
	'name' => ['s', 'John Smith'],
	'email' => ['s', 'jsmith@example.com'],
	'password' => ['s', 'Doi4piC0po'],
	'age' => ['i', 27]
];
db::insert($mysqli, 'user', $data);
```

## Update Query
Returns **TRUE** on success or **FALSE** on failure.
```php
db::update(object $mysqli, string $table_name, array $data [, array $where = null]);
```
Here is an example using external variables passed to the query via bind variables:
```php
$data = [
	'password' => ['s', 'bUc0It8bOf']
];
db::update($mysqli, 'user', $data, ['id' => 45]);
```

## Delete Query
Returns **TRUE** on success or **FALSE** on failure.
```php
db::delete(object $mysqli, string $table_name, [, array $where = null]);
```

## Raw Query
Returns **TRUE** on success or **FALSE** on failure.
```php
db::raw(object $mysqli, string $sql [, array $data_type]);
```
Here is an example using external variables passed to the query via bind variables:
```php
$user = db::raw($mysqli, 'SELECT * FROM user WHERE id = ?', ['i', ['id'] => 45]);
```