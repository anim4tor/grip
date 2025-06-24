<?php
	date_default_timezone_set('Europe/Prague');
	global $root; 
	$root = ($_SERVER['SERVER_NAME']==='myworkoutapp') ? '' : '/projects/myWorkoutApp/';
	// $root = '/';

	/*
	
		GLOBAL
	
	*/

	global $_GLOBAL;
	
	$_GLOBAL['timestamp'] = time();

	// $_GLOBAL['db'] = is_localhost() ? json_decode(file_get_contents($root.'config/_db.json'), true)['local'][0] : json_decode(file_get_contents($root.'config/_db.json'), true)['dist'][0];
	$_GLOBAL['db'] = json_decode(file_get_contents($root . $relpath . 'config/_db.json'), true)['dist'][0];


	global $DB;
	$DB = array();
	$DB['server'] = "sql.endora.cz:3308";
	$DB['login'] = "anim4tor";
	$DB['password'] = "maiden";
	$DB['database'] = "workout";

	// var_dump($_GLOBAL['db']);

	$_GLOBAL['czdays'] = array('neděle', 'pondělí', 'úterý', 'středa', 'čtvrtek', 'pátek', 'sobota');
	$_GLOBAL['czdays']['short'] = array('Ne', 'Po', 'Út', 'St', 'Čt', 'Pá', 'So');
	$_GLOBAL['czdays']['lokal'] = array('v neděli', 'v pondělí', 'v úterý', 've středu', 've čtvrtek', 'v pátek', 'v sobotu');
	
	$_GLOBAL['czmonth'] = array(1 => 'leden', 'únor', 'březen', 'duben', 'květen', 'červen', 'červenec', 'srpen', 'září', 'říjen', 'listopad', 'prosinec');
	$_GLOBAL['czmonth']['genitiv'] = array(1 => 'ledna', 'února', 'března', 'dubna', 'května', 'června', 'července', 'srpna', 'září', 'října', 'listopadu', 'prosince');
	
	$_GLOBAL['colors'] = array('#FFB900',	'#E74856',	'#0078D7',	'#0099BC',	
					  '#CA5010',	'#C30052',	'#6B69D6',	'#038387',	
					  '#FF8C00',	'#E81123',	'#0063B1',	'#2D7D9A',	
					  '#F7630C',	'#EA005E',	'#8E8CD8',	'#00B7C3',	
					  '#EF6950',	'#BF0077',	'#744DA9',	'#018574',	
					  '#DA3B01',	'#E3008C',	'#8764B8',	'#00B294',	
					  '#D13438',	'#C239B3',	'#B146C2',	'#00CC6A',	
					  '#FF4343',	'#9A0089',	'#881798',	'#10893E');

	
	/* 

		DATABASE:
		Connection

	*/

	function db_conn() {
		global $_GLOBAL;
	    global $db;
	    global $DB;
	    if ($db)
	        return $db;
	    
	    $db = new mysqli($DB['server'], $DB['login'], $DB['password'], $DB['database']);

	    if ($db->connect_errno) {
	        printf("Database connect failed: %s\n", $db->connect_error);
	        exit();
	    }

	    mysqli_set_charset($db, "utf8");
	    return $db;
	}


	/* 

		DATABASE:
		Structure

	*/



	/* 

		DATABASE:
		Fetch functions

	*/

	function db_fetch_table($name, $where = null, $order = null, $limit = null) {
		$table = array();

    	// connect database
		$db = db_conn();

		$query = "SELECT * FROM {$name}";

		// append where statemnet
		if(!is_null($where)) {
			$query .= " WHERE " . $where;
		}

		// append order statemnet
		if(!is_null($order)) {
			$query .= " ORDER BY " . $order;
		}

		// append limit statemnet
		if(!is_null($limit)) {
			$query .= " LIMIT " . $limit;
		}

		if ($sql = $db->query($query)) {

		    /* fetch object array */
		    while ($row = $sql->fetch_array(MYSQLI_ASSOC)) { 

				array_push($table, $row);

			}

		    /* free result set */
		    $sql->close();

		} else {
			echo("SQL ERROR while fetching table (". $db->errno .'): '. $db->error  . '. QUERY: ' . $query);
		    return false;
		}

		// echo('QUERY: ' . $query);

		// return
		return $table;
	}

	function db_fetch_column($table, $col, $where = null) {
		$column = array();

    	// connect database
		$db = db_conn();

		$query = "SELECT {$col} FROM {$table}";

		if(!is_null($where)) {
			$query .= " WHERE " . $where;
		}

		if ($sql = $db->query($query)) {

		    /* fetch object array */
		    while ($item = $sql->fetch_array(MYSQLI_ASSOC)) { 

				array_push($column, $item[$col]);

			}

		    /* free result set */
		    $sql->close();

		} else {
			echo("SQL ERROR while fetching table column (". $db->errno .'): '. $db->error  . '. QUERY: ' . $query);
		    return false;
		}


		// return
		return $column;
	}

	function db_fetch_row($table, $where = null, $id = null) {
		$item = array(); 

		// connect database
		$db = db_conn();

		$query = "SELECT * FROM {$table}";

		if(!is_null($where) && !is_null($id)) {
			$query .= " WHERE " . $where . " = '" . $id . "'";
		}

		$query .= " LIMIT 1";
		// echo $query;

		if ($sql = $db->query($query)) {

		    /* fetch object array */
			$item = $sql->fetch_array(MYSQLI_ASSOC);


		    /* free result set */
		    $sql->close();

		} else {
			echo("SQL ERROR while fetching table row (". $db->errno .'): '. $db->error . '. QUERY: ' . $query);
		    return false;
		}

		// return
		return $item;
	}

	function db_fetch_rows($table, $where = null, $order = null) {

		// init
		$items = array(); 

		// connect database
		$db = db_conn();

		$query = "SELECT * FROM {$table}";

		// append where statemnet
		if(!is_null($where)) {
			$query .= " WHERE " . $where;
		}

		// append order statemnet
		if(!is_null($order)) {
			$query .= " ORDER BY " . $order;
		}
		if ($sql = $db->query($query)) {

			if(mysqli_num_rows($sql)!=0) {
			    /* fetch object array */
			    while ($row = $sql->fetch_array(MYSQLI_ASSOC)) { 
			    	$items[] = $row;
				}
			}

		    /* free result set */
		    $sql->close();
		
		} else {
			echo("SQL ERROR while fetching table rows (". $db->errno .'): '. $db->error . '. QUERY: ' . $query);
		    return false;
		}

		// return
		return $items;
	}

	function db_fetch_element($table, $column, $where = null, $order = null, $limit = null) {
		$el = ''; 

		$db = db_conn();

		$query = "SELECT {$column} FROM {$table}";

		// append where statemnet
		if(!is_null($where)) {
			$query .= " WHERE " . $where;
		}

		// append order statemnet
		if(!is_null($order)) {
			$query .= " ORDER BY " . $order;
		}

		// append limit statemnet
		if(!is_null($limit)) {
			$query .= " LIMIT " . $limit;
		}

		if ($sql = $db->query($query)) {

		    /* fetch object array */
			$el = $sql->fetch_row()[0];


		    /* free result set */
		    $sql->close();

		} else {
			echo("SQL ERROR while fetching table element (". $db->errno .'): '. $db->error . '. QUERY: ' . $query);
		    return false;
		}

		// return
		return $el;
	}



	/* 

		DATABASE:
		Get functions

	*/


	function db_get_count($table, $column, $where = null) {

		$count = 0; 

		$db = db_conn();

		$query = "SELECT COUNT({$column}) FROM {$table}";

		// append where statemnet
		if(!is_null($where)) {
			$query .= " WHERE " . $where;
		}

		if ($sql = $db->query($query)) {

		    $count = $sql->fetch_row()[0];

		    /* free result set */
		    $sql->close();

		} else {
			echo("SQL ERROR (". $db->errno .'): '. $db->error);
		    return false;
		}

		// return
		return $count;
	}

	function db_get_sum($table, $column, $where = null) {

		$sum = 0; 

		$db = db_conn();

		$query = "SELECT SUM({$column}) FROM {$table}";

		// append where statemnet
		if(!is_null($where)) {
			$query .= " WHERE " . $where;
		}

		if ($sql = $db->query($query)) {

		    $sum = $sql->fetch_row()[0];

		    /* free result set */
		    $sql->close();

		} else {
			echo("SQL ERROR (". $db->errno .'): '. $db->error);
		    return false;
		}

		// return
		return $sum;
	}

	function db_get_max($table, $column, $where = null) {

		$sum = 0; 

		$db = db_conn();

		$query = "SELECT MAX({$column}) FROM {$table}";

		// append where statemnet
		if(!is_null($where)) {
			$query .= " WHERE " . $where;
		}

		if ($sql = $db->query($query)) {

		    $sum = $sql->fetch_row()[0];

		    /* free result set */
		    $sql->close();

		} else {
			echo("SQL ERROR (". $db->errno .'): '. $db->error);
		    return false;
		}

		// return
		return $sum;
	}


	/* 

		DATABASE:
		Insert and remove functions

	*/

	function db_insert_row($table, array $insert_object) {

    	// connect database
		$db = db_conn();

		$columns = array();
		$values = array();

		foreach ($insert_object as $column => $value) {
			$columns[] = $column;
			$values[] = "'" . $value . "'";
		}

		// implode update arrya
		$columns_string = implode(",",$columns);
		$values_string = implode(",",$values);

    	// update query
		$query="INSERT INTO {$table} ({$columns_string}) VALUES ({$values_string})";

	   	if ($sql = $db->query($query)) {

	   	    /* free result set */
	   	    // $sql->close();

	   		return $db->insert_id;
	   	    // return true;

	   	} else {
	   		echo "SQL ERROR while inserting row (". $db->errno ."): ". $db->error  . ". QUERY: " . $query;
	   	    return false;
	   	}


	}

	function db_insert_blank($table) {

		// connect database
		$db = db_conn();

    	// update query
		$query="INSERT INTO {$table} () VALUES ()";

	   	if ($sql = $db->query($query)) {

	   	    /* free result set */
	   	    // $sql->close();

	   		return $db->insert_id;
	   	    // return true;

	   	} else {
	   		echo "SQL ERROR while inserting row (". $db->errno ."): ". $db->error  . ". QUERY: " . $query;
	   	    return false;
	   	}

	}

	function db_delete_row($table, $where) {

    	// connect database
		$db = db_conn();

    	// delete query
		$query="DELETE FROM {$table} WHERE {$where}";

	   	if ($sql = $db->query($query)) {

	   	    /* free result set */
	   	    // $sql->close();

	   	    return true;

	   	} else {
	   		echo "SQL ERROR while deleting row (". $db->errno ."): ". $db->error  . ". QUERY: " . $query;
	   	    return false;
	   	}

	}




	/* 

		DATABASE:
		Update functions

	*/


	function db_update_element($table, $column, $value, $where) {

    	// connect database
		$db = db_conn();

    	// update query
	   	$query="UPDATE {$table} SET {$column} = '{$value}' WHERE {$where}";

	   	if ($sql = $db->query($query)) {

	   	    /* free result set */
	   	    // $sql->close();

	   	} else {
	   		echo "SQL ERROR while updating element (". $db->errno ."): ". $db->error  . ". QUERY: " . $query;
	   	    return false;
	   	}

	}

	function db_update_row($table, array $update_object, $where) {

    	// connect database
		$db = db_conn();

		$update = array();

		foreach ($update_object as $column => $value) {
			$update[] =  "{$column} = '{$db->real_escape_string($value)}'";
		}

		// implode update arrya
		$update_string = implode(",",$update);

    	// update query
	   	$query="UPDATE {$table} SET {$update_string} WHERE {$where}";

	   	if ($sql = $db->query($query)) {

	   	    /* free result set */
	   	    // $sql->close();

	   	    return true;

	   	} else {
	   		echo "SQL ERROR while updating row (". $db->errno ."): ". $db->error  . ". QUERY: " . $query;
	   	    return false;
	   	}

	}

	/* 

		ADMIN:
		Validation

	*/

	function is_admin() {
		return isset($_SESSION['admin']) && $_SESSION['admin']['valid'] === true;
	}

	function valid_admin($login,$pswd) {

		return db_get_count('admins', 'user', "pswd = '{$pswd}' AND user = '{$login}'") > 0 ? true : false;

	}



	/* 

		EVENTS:
		Feed & calendar functions

	*/

	function load_week($day = "Today") {
			
		$week = array();

		$todayDate = strftime('%G-%m-%d', $day);
		$today = strtotime($todayDate);
		$timestamp = strtotime('Monday this week', $today);

		$yesterday = strtotime('-1 day', $today);
		$tomorrow = strtotime('+1 day', $today);

		// var_dump($yesterday, $tomorrow);

		for ($i = 0; $i < 7; $i++) {
		    $week[$i]['date'] = strftime('%G-%m-%d', $timestamp);
		    $week[$i]['daynum'] = strftime('%e', $timestamp);
		    $week[$i]['name'] = strftime('%a', $timestamp);
		    $week[$i]['yesterday'] = $timestamp == $yesterday ? 1 : 0;
		    $week[$i]['this'] = $day == $timestamp ? 1 : 0;
		    $week[$i]['tomorrow'] = $timestamp == $tomorrow ? 1 : 0;
		    $timestamp = strtotime('+1 day', $timestamp);
		}

		return $week;
	}

	function load_week_days($day = "Today") {

		$week = array();

		$todayDate = strftime('%G-%m-%d', strtotime($day));
		$timestamp = strtotime($todayDate . 'Monday this week');
		for ($i = 0; $i < 7; $i++) {
		    $week[] = strftime('%G-%m-%d', $timestamp);
		    $timestamp = strtotime('+1 day', $timestamp);

		}

		return $week;
	}

	function load_day_workouts($days) {

		$workouts = array();

		$days = is_array($days) ? $days : array($days);
		foreach ($days as $day) { 
			$day = strftime('%G-%m-%d', strtotime($day));
			if($W = db_fetch_rows('workouts',"schedule = '{$day}'")) {
				foreach($W as $w) {
					$workouts[] = $w;
				}
			} else {
				// echo 'No workouts';
			}
		} 

		return $workouts;
	}

	function load_events($context = 'calendar', $start = 0, $per = -1, $filter = null) {

		// init
		$events_raw = array();
		
		// connect database
		$db = db_conn();

		// define order
		$order = $per < 0 ? 'DESC' : 'ASC';
		
		// set now datetime
		$now = new DateTime();

		// define datetime interval as normalized format
		if ($per > 0 && $start == 0) {
			$begin = $now->format('Y-m-d h:i:s');
			$end = $now->modify('last day of +'.$per.' month')->format('Y-m-d h:i:s');

		} elseif ($per > 0 && $start != 0) {
			$begin = $now->modify('last day of +'.$start.' month')->format('Y-m-d h:i:s');
			$end = $now->modify('last day of +'.$per.' month')->format('Y-m-d h:i:s');

		} elseif ($per < 0 && $start == 0) {
			$end = $now->format('Y-m-d h:i:s');
			$begin = $now->modify('first day of '.$per.' month')->format('Y-m-d h:i:s');

		} else {
			$end = $now->modify('first day of '.$start.' month')->format('Y-m-d h:i:s');
			$begin = $now->modify('first day of '.$per.' month')->format('Y-m-d h:i:s');

		}

		// fetch mkl events
		$mkl = array();
		$query =	"SELECT * 
					FROM mkl_draw 
					WHERE '{$begin}' <= CONCAT(datum, ' ', daytime) && CONCAT(datum, ' ', daytime) < '{$end}'
					ORDER BY datum {$order}, daytime {$order}";

		if ($sql = $db->query($query)) {
			if(mysqli_num_rows($sql)!=0) {
				
			    /* fetch object array */
			    while ($row = $sql->fetch_array(MYSQLI_ASSOC)) { 
			    	$item = array();
			   		$item['timestamp'] = strtotime($row['datum'] .' '. $row['daytime']);
			   		$item['mode'] = 'mkl';
			   		$item['data'] = $row;
		    		array_push($mkl,$item);

				}

			    /* free result set */
			    $sql->close();

			    // merge arrays
			    $events_raw = array_merge($events_raw, $mkl);

			}

		} else {
			echo("SQL ERROR while loading mkl events (". $db->errno .'): '. $db->error);
		    return false;
		}

		// fetch league events
		$league = array();
		$query =	"SELECT * 
					FROM league_draw 
					WHERE '{$begin}' <= CONCAT(date, ' ', time) && CONCAT(date, ' ', time) < '{$end}'
					ORDER BY date {$order}, time {$order}";

		if ($sql = $db->query($query)) {
			if(mysqli_num_rows($sql)!=0) {
				
			    /* fetch object array */
			    while ($row = $sql->fetch_array(MYSQLI_ASSOC)) { 
			    	$item = array();
			   		$item['timestamp'] = strtotime($row['date'] .' '. $row['time']);
			   		$item['mode'] = 'league';
			   		// $item['slug'] = $row['league'];
			   		$item['data'] = $row;
		    		array_push($league,$item);

				}
			    /* free result set */
			    $sql->close();

			    // merge arrays
			    $events_raw = array_merge($events_raw, $league);

			}

		} else {
			echo("SQL ERROR while loading league events (". $db->errno .'): '. $db->error);
		    return false;
		}


		// fetch news feed
		if($context == 'feed') {

			$news = array();

			$query =	"SELECT * 
						FROM novinky 
						WHERE '{$begin}' <= date && date < '{$end}'
						ORDER BY date {$order}";

			if ($sql = $db->query($query)) {
				if(mysqli_num_rows($sql)!=0) {
					
				    /* fetch object array */
				    while ($row = $sql->fetch_array(MYSQLI_ASSOC)) { 
				    	$item = array();
				   		$item['timestamp'] = strtotime($row['date']);
				   		$item['mode'] = 'news';
				   		$item['data'] = $row;
			    		array_push($news,$item);

					}
				    /* free result set */
				    $sql->close();

					// merge arrays
					$events_raw = array_merge($events_raw, $news);
				}

			} else {
				echo("SQL ERROR while loading news events (". $db->errno .'): '. $db->error);
			    return false;
			}

		}


		// group by years and months and days
		$events_sorted = array();
		foreach ($events_raw as $events_item) {
			$year = date('Y', $events_item['timestamp']); 
			$month = date('n', $events_item['timestamp']); 
			$day = date('j', $events_item['timestamp']); 
			$events_sorted[$year][$month][$day][] = $events_item;
		}

		// sort by date
		$events = array();

		foreach ($events_sorted as $year => $events_year) {
 			
 			// sort years
 			$order == 'DESC' ? krsort($events_year) : ksort($events_year);

 			foreach ($events_year as $month => $events_month) {
				
				// sort months
				$order == 'DESC' ? krsort($events_month) : ksort($events_month);

				foreach ($events_month as $day => $events_day) {

					// sort days
					$columns = array_column($events_day, 'timestamp');
					array_multisort($columns, $order == 'DESC' ? SORT_DESC : SORT_ASC, $events_day);
					$events[$year][$month][$day] = $events_day;
				}
 			}
		}

		// return
		return $events;
	}


	/* 

		WORKOUT:
		Edits

	*/

	function add_workout($add) {

		// insert db workout
		if($id = db_insert_row('workout', $add)) {

			// print('<pre>Result added: ');
			// print_r($add);
			// print('</pre>');

			// fetch data 
			// $workout = fetch_result($id);

			// updates
			
		} else {
			return;
		}

	}

	function add_set($set) {

		// insert db workout
		if($id = db_insert_row('sets', $set)) {

			// print('<pre>Result added: ');
			// print_r($add);
			// print('</pre>');

			// fetch data 
			// $workout = fetch_result($id);

			// updates
			return $id;
			
		} else {
			return;
		}

	}

	function add_lift($lift) {

		// insert db workout
		if($id = db_insert_row('lifts', $lift)) {

			// print('<pre>Result added: ');
			// print_r($add);
			// print('</pre>');

			// fetch data 
			// $workout = fetch_result($id);

			// updates
			return $id;
			
		} else {
			return;
		}

	}

	function get_lift_history($lift) {
		$history = array();

		$L = db_fetch_row('lifts',"id", $lift);

		if($LIFT = db_fetch_rows('lifts', "exercise = '{$L['exercise']}' AND mods = '{$L['mods']}'")) {
			foreach ($LIFT as $key => $L) {
				# code...
				$schedule = db_fetch_element('workouts','schedule',"id = '{$L['workout']}'");
				$history[$key] = $L;
				$history[$key]['schedule'] = $schedule;
			}
		} else {

		}
		array_multisort(array_column($history, 'schedule'), SORT_DESC ,$history);
		// var_dump($bodypart);
		return $history;
	}

	function get_lift_progress($lift) {
		$progress = 0;
		
		$history = get_lift_history($lift);

		$index = array_search($lift, array_column($history, 'id'));
		// var_dump($history);
		// var_dump($index);

		// return $index;
		return $history[$index]['volume'] - $history[$index + 1]['volume'];
	}

	function get_lift_bodypart($lift) {
		$bodypart = array();
		$e = db_fetch_element('lifts','exercise',"id = '{$lift}'");
		$E = db_fetch_row('exercises', 'id', $e);
		if($b = db_fetch_rows('bodypart', "id = '{$E['bodypart']}'")) {
			$bodypart[$b[0]['slug']] = $b[0];
		} else {

		}
		// var_dump($bodypart);
		return $bodypart;
	}

	function get_workout_bodypart($workout) {
		$bodypart = array();
		$lifts = db_fetch_element('workouts','lifts',"id = '{$workout}'");

		foreach (json_decode($lifts, true) as $l) {
			$e = db_fetch_element('lifts','exercise',"id = '{$l}'");
			$E = db_fetch_row('exercises', 'id', $e);
			if($b = db_fetch_rows('bodypart', "id = '{$E['bodypart']}'")) {
				$bodypart[$b[0]['slug']] = $b[0];
			} else {

			}
		}
		
		// var_dump($bodypart);
		return $bodypart;
	}

	function get_exercise_factors($set) {

		$factors = array();

		$s = db_fetch_row('sets','id',$set);
		$w = db_fetch_element('workouts','bodyweight',"id = '" . db_fetch_element('sets','workout',"id = {$set}") . "'");
		
		$factors['mods'] = array();
		$factors['bw'] = $w ? $w : '80.0';
		$factors['part'] = db_fetch_element('bodypart','factor',"id = '" . db_fetch_element('exercises','bodypart', "id = '" . db_fetch_row('exercises','id', db_fetch_element('lifts','exercise',"id = {$s['lift']}") )['id'] . "'") . "'");
		$factors['bwf'] = db_fetch_row('exercises','id', db_fetch_element('lifts','exercise',"id = {$s['lift']}") )['bw_factor'];
		$mods = json_decode(db_fetch_element('lifts','mods',"id = {$s['lift']}"),true);
		foreach ($mods as $slug) {
			$factors['mods'][$slug] = db_fetch_element('mods','factor', "slug = '{$slug}'");
		}
		// $l = db_fetch_element('sets','lift',"id = {$set}");
		// var_dump($factors);
		// var_dump($w);

		// if($S = db_fetch_row('sets','id',$set)) {

		// 	$S['weight'] = $S['weight'] == 0 ? 80.0 : $S['weight'];
		// 	// var_dump($S['goal']);
		// 	$score = $S['reps'] * $S['weight'];
		// } else {

		// }
		
		// var_dump($score);
		return $factors;

	}

	function get_set_score($set) {
		$score = 0;
		
		if($S = db_fetch_row('sets','id',$set)) {

			$factors = get_exercise_factors($set);
			// var_dump($factors);

			// $S['weight'] = $S['weight'] == 0 ? 80.0 : $S['weight'];
			// var_dump($S['goal']);
			$score = array_key_exists('assisted', $factors['mods']) ? pow(( $factors['bwf'] * $factors['bw'] ),1.0) - pow($S['weight'],1.0) : pow($S['weight'],1.0) + pow(( $factors['bw'] * $factors['bwf'] ),1.0);
			// var_dump($score);
			foreach ($factors['mods'] as $slug => $mf) {
				# code...
				$score *= $slug != 'assisted' ? $mf : 1;
			}

			$score *= $factors['part'];
			$score *= $S['reps'];
		

		} else {

		}
		
		// var_dump($score);
		return $score;
	}

	function get_sets_count($liftId) {
		$count = 0;
		$hasDropset = false;
		
		if($L = db_fetch_element('lifts','sets',"id = {$liftId}")) {
			foreach (json_decode($L, true) as $s) {
				$count += $type = db_fetch_element('sets','type',"id = {$s}") != 'D' ? 1 : 0;
				if($type == 'D') $hasDropset = true;
			}
			if ($hasDropset) {
				$count++;
				$hasDropset = false;
			}
			// $count = sizeof(json_decode($L, true));
		} else {

		}
		
		// var_dump($count);
		return $count;
	}

	function calc_lift_score($lift) {
		$volume = 0;

		if($sets = db_fetch_element('lifts','sets',"id = {$lift}")) {
			foreach (json_decode($sets, true) as $s) {
				$factors = get_exercise_factors($s);
				$volume += get_set_score($s);
			}
		} else {

		}

		return $volume;
	}

	function calc_volume($workout) {
		$volume = 0;

		$W = db_fetch_row('workouts',"id", $workout);

		foreach(json_decode($W['lifts'],true) as $l) {
			if($sets = db_fetch_element('lifts','sets',"id = {$l}")) {
				foreach (json_decode($sets, true) as $s) {
					$volume += get_set_score($s);
				}
			} else {

			}
		}

		return $volume;
	}

	function calc_sets(array $lifts) {
		$count = 0;

		foreach($lifts as $id) {
			// var_dump($l);
			$count += get_sets_count($id);
		}

		return $count;
	}

	function calc_load($workout) {

		$load = array();

		// bodyparts
		foreach (db_fetch_table('bodypart') as $bodypart) {
			$load[$bodypart['slug']]['setcount'] = 0;
		}

		if($W = db_fetch_row('workouts',"id", $workout)) {
			// var_dump($W);
			foreach (json_decode($W['lifts'],true) as $l) {
				$L = db_fetch_row('lifts','id', $l);
				// var_dump($L);
				$E = db_fetch_row('exercises','id', $L['exercise']);
				// var_dump($E);
				$B = db_fetch_row('bodypart','id', $E['bodypart']);
				// var_dump($B);
				$s = sizeof(json_decode($L['sets'],true));
				// echo $s;
				$load[$B['slug']]['setcount'] += $s;
			}
		} else {
			// echo 'No workouts';
		}


		return $load;
	}

	function calc_week_load(array $week) {

		$LOAD = array();


		$weekFirst = $week[0]['date'];
		$weekLast = $week[sizeof($week)- 1]['date'];

		$factor = 1900;
		$factor = 7;

		// bodyparts
		$BODY = db_fetch_table('bodypart');
		$BODY[] = array('name' => 'Rest','slug' => 'rest','count' => $factor);

		$total = 0;
		$sets = 0;

		foreach ($week as $day) { 

			foreach ($BODY as $PART) {
				$LOAD['week'][$day['date']][$PART['slug']]['count'] = 0;
				// $LOAD[$day['date']][$PART['slug']]['color'] = $PART['color'];
			}
			// var_dump($day['date']);
			if($W = db_fetch_row('workouts',"schedule", $day['date'])) {
				// var_dump($W);
				foreach (json_decode($W['lifts'],true) as $l) {
					$L = db_fetch_row('lifts','id', $l);
					// var_dump($L);
					$E = db_fetch_row('exercises','id', $L['exercise']);
					// var_dump($E);
					$B = db_fetch_row('bodypart','id', $E['bodypart']);
					// var_dump($B);
					$s = sizeof(json_decode($L['sets'],true));
					$v = $L['volume'];
					// echo $s;
					$LOAD['week'][$day['date']][$B['slug']]['count'] += $s;
					$total += $v;
					$sets += $s;

				}
				if($W['title'] == 'Rest day') {
					$LOAD['week'][$day['date']]['rest']['count'] = $factor;
				}
			} else {
				// echo 'No workouts';
			}
		}

		$LOAD['total'] = $total;
		$LOAD['sets'] = $sets;
		$LOAD['unit'] = $factor;

		// $W = db_fetch_rows('workouts',"{$weekFirst} > schedule < {$weekLast}");
		return $LOAD;


	}


	/* 

		UTILS:
		Helper functions

	*/

	function isJson($string) {
	   json_decode($string);
	   return json_last_error() === JSON_ERROR_NONE;
	}

	function is_localhost() {
		
		// set the array for testing the local environment
		$whitelist = array( '127.0.0.1', '::1' );
		
		// check if the server is in the array
		if ( in_array( $_SERVER['REMOTE_ADDR'], $whitelist ) ) {
			
			// this is a local environment
			return true;
			
		}
		
	}

	function str_beauty($str) {

		$beauty = $str;

		// remove &nbsp;
		// $converted = strtr($str, array_flip(get_html_translation_table(HTML_ENTITIES, ENT_QUOTES))); 
		$beauty = str_replace("\xc2\xa0",' ',$beauty); 
		$beauty = str_replace("<br>",'<br><span class="--dimm">+</span>',$beauty); 

		// replace substrings
		$beauty = ltrim(str_replace('x','',$beauty));

		return $beauty;

	}

	function DOMinnerHTML(DOMNode $element) 
	{ 
	    $innerHTML = ""; 
	    $children  = $element->childNodes;

	    foreach ($children as $child) 
	    { 
	        $innerHTML .= $element->ownerDocument->saveHTML($child);
	    }

	    return $innerHTML; 
	} 

	
	function hours_tofloat($val){
	    if (empty($val)) {
	        return 0;
	    }
	    $parts = explode(':', $val);
	    return $parts[0] + floor(($parts[1]/60)*100) / 100;
	}

	if (!function_exists('mb_ucfirst') && function_exists('mb_substr')) {
	    function mb_ucfirst($string) {
	        $string = mb_strtoupper(mb_substr($string, 0, 1)) . mb_substr($string, 1);
	        return $string;
	    }
	}

	// based on original work from the PHP Laravel framework
	if (!function_exists('str_contains')) {
	    function str_contains($haystack, $needle) {
	        return $needle !== '' && mb_strpos($haystack, $needle) !== false;
	    }
	}
	
	function remove_accent($str) {
	  $a = array('À','Á','Â','Ã','Ä','Å','Æ','Ç','È','É','Ê','Ë','Ì','Í','Î','Ï','Ð','Ñ','Ò','Ó','Ô','Õ','Ö','Ø','Ù','Ú','Û','Ü','Ý','ß','à','á','â','ã','ä','å','æ','ç','è','é','ê','ë','ì','í','î','ï','ñ','ò','ó','ô','õ','ö','ø','ù','ú','û','ü','ý','ÿ','Ā','ā','Ă','ă','Ą','ą','Ć','ć','Ĉ','ĉ','Ċ','ċ','Č','č','Ď','ď','Đ','đ','Ē','ē','Ĕ','ĕ','Ė','ė','Ę','ę','Ě','ě','Ĝ','ĝ','Ğ','ğ','Ġ','ġ','Ģ','ģ','Ĥ','ĥ','Ħ','ħ','Ĩ','ĩ','Ī','ī','Ĭ','ĭ','Į','į','İ','ı','Ĳ','ĳ','Ĵ','ĵ','Ķ','ķ','Ĺ','ĺ','Ļ','ļ','Ľ','ľ','Ŀ','ŀ','Ł','ł','Ń','ń','Ņ','ņ','Ň','ň','ŉ','Ō','ō','Ŏ','ŏ','Ő','ő','Œ','œ','Ŕ','ŕ','Ŗ','ŗ','Ř','ř','Ś','ś','Ŝ','ŝ','Ş','ş','Š','š','Ţ','ţ','Ť','ť','Ŧ','ŧ','Ũ','ũ','Ū','ū','Ŭ','ŭ','Ů','ů','Ű','ű','Ų','ų','Ŵ','ŵ','Ŷ','ŷ','Ÿ','Ź','ź','Ż','ż','Ž','ž','ſ','ƒ','Ơ','ơ','Ư','ư','Ǎ','ǎ','Ǐ','ǐ','Ǒ','ǒ','Ǔ','ǔ','Ǖ','ǖ','Ǘ','ǘ','Ǚ','ǚ','Ǜ','ǜ','Ǻ','ǻ','Ǽ','ǽ','Ǿ','ǿ');
	  $b = array('A','A','A','A','A','A','AE','C','E','E','E','E','I','I','I','I','D','N','O','O','O','O','O','O','U','U','U','U','Y','s','a','a','a','a','a','a','ae','c','e','e','e','e','i','i','i','i','n','o','o','o','o','o','o','u','u','u','u','y','y','A','a','A','a','A','a','C','c','C','c','C','c','C','c','D','d','D','d','E','e','E','e','E','e','E','e','E','e','G','g','G','g','G','g','G','g','H','h','H','h','I','i','I','i','I','i','I','i','I','i','IJ','ij','J','j','K','k','L','l','L','l','L','l','L','l','l','l','N','n','N','n','N','n','n','O','o','O','o','O','o','OE','oe','R','r','R','r','R','r','S','s','S','s','S','s','S','s','T','t','T','t','T','t','U','u','U','u','U','u','U','u','U','u','U','u','W','w','Y','y','Y','Z','z','Z','z','Z','z','s','f','O','o','U','u','A','a','I','i','O','o','U','u','U','u','U','u','U','u','U','u','A','a','AE','ae','O','o');
	  return str_replace($a, $b, $str);
	}

	function render_slug($str) {
	  return strtolower(preg_replace(array('/[^a-zA-Z0-9 -]/', '/[ -]+/', '/^-|-$/'), array('', '-', ''), remove_accent($str)));
	}




class Calendar {
	
    private $active_year, $active_month, $active_day;
    private $events = [];

    public function __construct($date = null) {
        $this->active_year = $date != null ? date('Y', strtotime($date)) : date('Y');
        $this->active_month = $date != null ? date('n', strtotime($date)) : date('m');
        $this->active_day = $date != null ? date('d', strtotime($date)) : date('d');
    }

    public function add_event($txt, $date, $days = 1, $category = '', $fullday = 0) {
        $category = $category ? '' . $category : $category;
        $fullday = $fullday ? '--fullday' : null;
        $this->events[] = [$txt, $date, $days, $category, $fullday];
    }

    public function __toString() {
    	global $_GLOBAL;
        $num_days = date('t', strtotime($this->active_day . '-' . $this->active_month . '-' . $this->active_year));
        $num_days_last_month = date('j', strtotime('last day of previous month', strtotime($this->active_day . '-' . $this->active_month . '-' . $this->active_year)));
        $days = [0 => 'Mon', 1 => 'Tue', 2 => 'Wed', 3 => 'Thu', 4 => 'Fri', 5 => 'Sat', 6 => 'Sun'];
        $days_cz = [0 => 'Po', 1 => 'Út', 2 => 'St', 3 => 'Čt', 4 => 'Pá', 5 => 'So', 6 => 'Ne'];
        $first_day_of_week = array_search(date('D', strtotime($this->active_year . '-' . $this->active_month . '-1')), $days);
        $month_num = date('n', strtotime($this->active_year . '-' . $this->active_month . '-' . $this->active_day));
        $month_name = date('F', strtotime($this->active_year . '-' . $this->active_month . '-' . $this->active_day));
        $html = '
	        <div class="page__title">
	        	<h1>' . $month_name . '</h1>
	        	<h2><a href="week.php" class="c-text-5">W</a><span class="w-tiny c-text-5">/</span><a href="month.php" class="">M</a></h2>
	        </div>
	        <div></div>
        ';
        $html .= '<div class="calendar calendar__month">';
        $html .= '<div class="calendar__header">';
        foreach ($days as $day) {
            $html .= '
                <div class="calendar__day">	
                    <span class="label">' . $day . '</span>
                </div>
            ';
        }
        $html .= '</div>';
        $html .= '<div class="calendar__week c-text-5">';
        for ($i = $first_day_of_week; $i > 0; $i--) {
            $html .= '
                <div class="day --ignore">
                    <div class="num c-text-5">' . ($num_days_last_month-$i+1) . '</div>
                </div>
            ';
        }
        for ($i = 1; $i <= $num_days; $i++) {
            $selected = '';
           
            if (date("Y-m-d", time()) == date('Y-m-d', strtotime( $this->active_year .'-'. $this->active_month .'-'. $i ))) {
                $selected = ' today';
            }
            $html .= '<a href="week.php?d=' . ($this->active_year .'-'. $this->active_month .'-'. $i). '" class="day ' . $selected . '">';
            $html .= '<div class="num"><span>' . $i . '</span></div>';
            $html .= '<div class="events">
            	

            ';
            foreach ($this->events as $event) {
                for ($d = 0; $d <= ($event[2]-1); $d++) {
                	$first = $d == 0 ? ' --first' : '';
                	$last = $d == $event[2]-1 ? ' --last' : '';
                    if (date('y-m-d', strtotime($this->active_year . '-' . $this->active_month . '-' . $i . ' -' . $d . ' day')) == date('y-m-d', strtotime($event[1]))) {
                    	$html .= $event[4] ? '<span class="event --spacer"></span>' : '';
                        $html .= '<div data-event="'. $event[3]. '" class="event bg-' . $event[3] . ' ' . $event[4] . $first . $last . '" >';
                        // $html .= '<span class="event__label">'.$event[0].'</span>';
                        $html .= '</div>';
                    }
                }
            }
            $html .= '</div>';
            // $html .= file_get_contents('template/component/loader.php');
            $html .= '</a>';
        }
        for ($i = 1; $i <= (35-$num_days-max($first_day_of_week, 0)); $i++) {
            $html .= '
                <div class="day ignore">
                    <div class="num c-text-5">' . $i . '</div>
                </div>
            ';
        }
        $html .= '</div>';
        $html .= '</div>';
        return $html;
    }

}
