# DB

A simple PHP MySQLi wrapper

## Initialisation
All functions require a MySQLi object created with `mysqli_connect` to be passed.

## Select Query
Returns data array on **TRUE** or **FALSE** if no results are found.
```php
db::select(object $mysqli, string $table_name 
	[, mixed $rows [, array $where = null [, array $order_by = null [, string $limit]]]]);
```

## Insert Query
Returns **TRUE** on success or **FALSE** on failure.
```php
$data = [
	'name' => ['s', 'John Smith'],
	'email' => ['s', 'jsmith@example.com'],
	'password' => ['s', 'Doi4piC0po'],
	'age' => ['i', 27]
];
db::insert(object $mysqli, string $table_name, array $data);
```

## Update Query
Returns **TRUE** on success or **FALSE** on failure.
```php
$data = [
	'password' => ['s', 'bUc0It8bOf']
];
db::update(object $mysqli, string $table_name, array $data [, array $where = null]);
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