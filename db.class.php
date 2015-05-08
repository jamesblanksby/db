<?php
class db {

	public static function select($db, $table, $row_array = '*', $where_array = null, $order_array = null, $limit = null) {
		$sql = "";

		$sql .= "SELECT ";

		if(is_array($row_array)) :
			$array_count = count($row_array);
			foreach($row_array as $index => $row) :
				$sql .= "{$row}" . ($array_count > 1 && $array_count - 1 != $index ? ", " : " ");
			endforeach;
		else :
			$row = $row_array;
			$sql .= "{$row} ";
		endif;

		$sql .= "FROM {$table} ";

		if($where_array !== null) :
			$sql .= "WHERE ";
			$array_count = count($where_array);
			$index = 0;
			foreach($where_array as $row => $value) :
				$value = (is_string($value) ? "'" . $value . "'" : $value);
				if(strpos($value, '%') === false) :
					$comparison = " = ";
				else :
					$comparison = " LIKE ";
				endif;
				$sql .= "{$row}" . $comparison . "{$value}" . ($array_count > 1 && $array_count - 1 != $index ? " AND " : " ");
				$index++;
			endforeach;
		endif;

		if($order_array !== null) :
			$sql .= "ORDER BY ";
			$array_count = count($order_array);
			$index = 0;
			foreach($order_array as $row => $sort) :
				$sql .= "{$row} {$sort}" . ($array_count > 1 && $array_count - 1 != $index ? ", " : " ");
				$index++;
			endforeach;
		endif;

		if($limit !== null) :
			$sql .= "LIMIT {$limit}";
		endif;

		$result = $db->query($sql);

		if($result === false) :
			trigger_error($db->error, E_USER_ERROR);
		else : 
			if($result->num_rows > 0) :
				$array = [];
				while($row = $result->fetch_object()) :
					array_push($array, $row);
				endwhile;
				return $array;
			endif;
		endif;
		return false;
	}

	public static function insert($db, $table, $data_array) {
		$sql = "";

		$sql .= "INSERT INTO {$table}";

		$array_count = count($data_array);
		if($array_count > 0) :
			$sql .= "(";
			$index = 0;
			foreach($data_array as $row => $value) :
				$sql .= "{$row}" . ($array_count > 1 && $array_count - 1 != $index ? ", " : "");
				$index++;
			endforeach;
			$sql .= ") ";

			$index = 0;
			$sql .= "VALUES ";
			$sql .= "(";
			foreach($data_array as $data) :
				$sql .= "?" . ($array_count > 1 && $array_count - 1 != $index ? ", " : "");
				$index++;
			endforeach;
			$sql .= ") ";

			$stmt = $db->prepare($sql);
			if($stmt === false) :
				trigger_error($db->error, E_USER_ERROR);
			endif;

			$param = [];

			$param_type = "";
			foreach($data_array as $row => $data) :
				$param_type .= $data[0];
			endforeach;

			$param[] = & $param_type;

			foreach($data_array as $row => $data) :
				$param[] = & $data_array[$row][1];
			endforeach;

			call_user_func_array(array($stmt, 'bind_param'), $param);

			$stmt->execute();

			return $stmt;
		endif;
		return false;
	}

	public static function update($db, $table, $data_array, $where_array = null) {
		$sql = "";

		$sql .= "UPDATE {$table} ";

		$array_count = count($data_array);
		if($array_count > 0) :
			$sql .= "SET ";
			$index = 0;
			foreach($data_array as $row => $value) :
				$sql .= "{$row} = ?" . ($array_count > 1 && $array_count - 1 != $index ? ", " : " ");
				$index++;
			endforeach;

			if($where_array !== null) :
				$sql .= "WHERE ";
				$array_count = count($where_array);
				$index = 0;
				foreach($where_array as $row => $value) :
					$value = (is_string($value) ? "'" . $value . "'" : $value);
					$sql .= "{$row} = {$value}" . ($array_count > 1 && $array_count - 1 != $index ? " AND " : " ");
					$index++;
				endforeach;
			endif;

			$stmt = $db->prepare($sql);
			if($stmt === false) :
				trigger_error($db->error, E_USER_ERROR);
			endif;

			$param = [];

			$param_type = "";
			foreach($data_array as $row => $data) :
				$param_type .= $data[0];
			endforeach;

			$param[] = & $param_type;

			foreach($data_array as $row => $data) :
				$param[] = & $data_array[$row][1];
			endforeach;

			call_user_func_array(array($stmt, 'bind_param'), $param);

			$stmt->execute();

			return $stmt;
		endif;
		return false;
	}

	public static function delete($db, $table, $where_array = null) {
		$sql = "";

		$sql .= "DELETE ";
		$sql .= "FROM {$table} ";

		if($where_array !== null) :
			$sql .= "WHERE ";
			$array_count = count($where_array);
			$index = 0;
			foreach($where_array as $row => $value) :
				$value = (is_string($value) ? "'" . $value . "'" : $value);
				$sql .= "{$row} = {$value}" . ($array_count > 1 && $array_count - 1 != $index ? " AND " : " ");
				$index++;
			endforeach;
		endif;

		$result = $db->query($sql);

		if($result === false) :
			trigger_error($db->error, E_USER_ERROR);
		else : 
			return $result;
		endif;
	}

	public static function raw($db, $sql, $parameter = null) {
		if($parameter !== null) :
			$stmt = $db->prepare($sql);

			if($stmt === false) :
				trigger_error($db->error, E_USER_ERROR);
			endif;

			$param_type = array_shift($parameter);
			$param[] = & $param_type;

			foreach($parameter as $index => $value) :
				$param[] = & $parameter[$index];
			endforeach;

			call_user_func_array(array($stmt, 'bind_param'), $param);

			$stmt->execute();

			return $stmt;
		else :
			$result = $db->query($sql);
			if($result === false) :
				trigger_error($db->error, E_USER_ERROR);
			else :
				return $result;
			endif;
		endif;
	}
}