<?php
	date_default_timezone_set('Europe/Prague');
	$root = '';

	/*
	
		GLOBAL
	
	*/

	global $_GLOBAL;
	
	$_GLOBAL['timestamp'] = time();

	// $_GLOBAL['db'] = is_localhost() ? json_decode(file_get_contents($root.'config/_db.json'), true)['local'][0] : json_decode(file_get_contents($root.'config/_db.json'), true)['dist'][0];
	$_GLOBAL['db'] = json_decode(file_get_contents($relpath.'config/_db.json'), true)['dist'][0];

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
	    if ($db)
	        return $db;
	    
	    $db = new mysqli($_GLOBAL['db']['server'], $_GLOBAL['db']['login'], $_GLOBAL['db']['password'], $_GLOBAL['db']['database']);

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

	function db_fetch_column($col, $where = null) {
		$column = array();

    	// connect database
		$db = db_conn();

		$query = "SELECT {$col} FROM `archive`";

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

	function db_fetch_rows($table, $where = null) {

		// init
		$items = array(); 

		// connect database
		$db = db_conn();

		$query = "SELECT * FROM {$table} WHERE {$where}";
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

		ČKA:
		Fetch results if possible

	*/


	function fetch_cka_table($id) {

		//
		$table = array();

		// load game html
		$DOM = new DOMDocument();
		libxml_use_internal_errors(true);
		$DOM->loadHTMLFile('https://www.kuzelky.com/index.php?poi=tabul&c_soutez='.$id.'');
		
		// find table
		$tr = $DOM->getElementsByTagName('tr');
		// var_dump($tr->length);

		// parse table header
		foreach ($tr->item(1)->getElementsByTagName('td') as $td) {
			$table['header'][] = $td->textContent;
		}

		// parse table rows
		$table['items'] = array();
		for ($i = 2, $j = 0; $i < $tr->length; $i++, $j++) {
			$table['items'][$j]['test'] = $j;
			foreach ($tr->item($i)->getElementsByTagName('td') as $key => $td) {
				$table['items'][$j][] = $td->textContent;
			}
		}

		// return results array
		$table['cka_id'] = $id;
		return $table;
	}

	function fetch_cka_header($id) {

		//
		$result = array();

		// load game html
		$DOM = new DOMDocument();
		libxml_use_internal_errors(true);
		$DOM->loadHTMLFile('https://www.kuzelky.com/index.php?poi=zapas&c_zapas='.$id.'');
		
		// find table header
		$tr = $DOM->getElementsByTagName('tr')->item(0)->getElementsByTagName('td');


		// parse header nodes 
		$result = array(

			'home' => array(
				'name' => str_beauty($tr->item(0)->textContent),
				'plus' => $tr->item(1)->textContent,
				'full' => $tr->item(2)->textContent,
				'stop' => $tr->item(3)->textContent,
				'error' => $tr->item(4)->textContent,
				'score' => $tr->item(5)->textContent,
				'points' => $tr->item(6)->textContent,
			),

			'diff' => $tr->item(7)->textContent,

			'visit' => array(
				'name' => str_beauty($tr->item(8)->textContent),
				'plus' => $tr->item(9)->textContent,
				'full' => $tr->item(10)->textContent,
				'stop' => $tr->item(11)->textContent,
				'error' => $tr->item(12)->textContent,
				'score' => $tr->item(13)->textContent,
				'points' => $tr->item(14)->textContent,
			)
		);

		// return results array
		return $result;
	}

	function fetch_cka_game($id) {

		//
		$game = array();

		// load game html
		$DOM = new DOMDocument();
		libxml_use_internal_errors(true);
		$DOM->loadHTMLFile('https://www.kuzelky.com/index.php?poi=zapas&c_zapas='.$id.'');
		

		$map = array(
			'0' => array('4','5','6'),
			'1' => array('8','9','10'),
			'2' => array('12','13','14'),
			'3' => array('16','17','18'),
			'4' => array('20','21','22'),
			'5' => array('24','25','26'),
		);
		$tr = $DOM->getElementsByTagName('tr');

		// find table header
		$th = $tr->item(0)->getElementsByTagName('td');

		// parse header nodes 
		$header = array(

			'home' => array(
				'name' => $th->item(0)->textContent,
				'plus' => $th->item(1)->textContent,
				'full' => $th->item(2)->textContent,
				'stop' => $th->item(3)->textContent,
				'error' => $th->item(4)->textContent,
				'score' => $th->item(5)->textContent,
				'points' => $th->item(6)->textContent,
			),

			'diff' => $th->item(7)->textContent,

			'visit' => array(
				'name' => $th->item(8)->textContent,
				'plus' => $th->item(9)->textContent,
				'full' => $th->item(10)->textContent,
				'stop' => $th->item(11)->textContent,
				'error' => $th->item(12)->textContent,
				'score' => $th->item(13)->textContent,
				'points' => $th->item(14)->textContent,
			)
		);

		$game['header'] = $header;

		// find results
		$results_raw = array();
		foreach ($map as $i => $r) {
			foreach ($r as $j => $index) {
				# code...
				if($tr->item($index - 1) !== null) {
					$results_raw[$i][] = $tr->item($index - 1)->getElementsByTagName('td');
				}
			}
			# code...
		}

		// parse results
		$results = array();
		foreach ($results_raw as $td) {
			
			// test if result
			if(!empty($td['0']->item(0)->textContent)) {

				$result = array(
					'home' => array(
						'id' => $td['2']->item(0)->textContent,
						'player' => str_beauty(DOMinnerHTML($td['0']->item(0)->getElementsByTagName('a')->item(0))),
						'lane' => array(
							'0' => array(
								'full' => $td['0']->item(2)->textContent,
								'stop' => $td['0']->item(3)->textContent,
								'error' => $td['0']->item(4)->textContent,
								'total' => $td['0']->item(5)->textContent 
							),
							'1' => array(
								'full' => $td['1']->item(1)->textContent,
								'stop' => $td['1']->item(2)->textContent,
								'error' => $td['1']->item(3)->textContent,
								'total' => $td['1']->item(4)->textContent 
							)
						),
						'points' => $td['0']->item(6)->textContent,
					),
					'visit' => array(
						'id' => $td['2']->item(6)->textContent,
						'player' => str_beauty(DOMinnerHTML($td['0']->item(8)->getElementsByTagName('a')->item(0))),
						'lane' => array(
							'0' => array(
								'full' => $td['0']->item(10)->textContent,
								'stop' => $td['0']->item(11)->textContent,
								'error' => $td['0']->item(12)->textContent,
								'total' => $td['0']->item(13)->textContent 
							),
							'1' => array(
								'full' => $td['1']->item(6)->textContent,
								'stop' => $td['1']->item(7)->textContent,
								'error' => $td['1']->item(8)->textContent,
								'total' => $td['1']->item(9)->textContent 
							)
						),
						'points' => $td['0']->item(14)->textContent,
					),
					'diff' => $td['0']->item(7)->textContent
				);

				// store parsed result data
				$results[] = $result;
				
			}
			
		}

		// store game results
		$game['results'] = $results;

		// var_dump($results);
	
		// return results array
		return $game;
	
	}

	
	function fetch_cka_game_update($id) {

		// fetch cka game data as object
		$template = fetch_cka_game($id);

		// parse game data into update object
		$temp_header = $template['header'];
		$draw = array(

			'hgames' => 1,
			'hwins' => $temp_header['home']['plus'] > $temp_header['visit']['plus'] ? 1 : 0,
			'hties' => $temp_header['home']['plus'] < $temp_header['visit']['plus'] ? 1 : 0,
			'hloss' => $temp_header['home']['plus'] == $temp_header['visit']['plus'] ? 1 : 0,
			'hplus' => intval($temp_header['home']['plus']),
			'hminus' => intval($temp_header['visit']['plus']),
			'hfull' => intval($temp_header['home']['full']),
			'hstop' => intval($temp_header['home']['stop']),
			'herror' => intval($temp_header['home']['error']),
			'hscore' => intval($temp_header['home']['score']),
			'hpoints' => intval($temp_header['home']['points']),

			'vgames' => 1,
			'vwins' => $temp_header['visit']['plus'] > $temp_header['home']['plus'] ? 1 : 0,
			'vties' => $temp_header['visit']['plus'] < $temp_header['home']['plus'] ? 1 : 0,
			'vloss' => $temp_header['visit']['plus'] == $temp_header['home']['plus'] ? 1 : 0,
			'vplus' => intval($temp_header['visit']['plus']),
			'vminus' => intval($temp_header['home']['plus']),
			'vfull' => intval($temp_header['visit']['full']),
			'vstop' => intval($temp_header['visit']['stop']),
			'verror' => intval($temp_header['visit']['error']),
			'vscore' => intval($temp_header['visit']['score']),
			'vpoints' => intval($temp_header['visit']['points']),

			'diff' => intval($temp_header['diff']),
			'played' => 1
		);

		// db update draw item
		if(db_update_row('league_draw', $draw, "cka_id = '{$id}'")) {

			$game = fetch_game('league_draw','cka_id', $id);
			
			$temp_results = $template['results'];
			foreach ($temp_results as $temp_result) {

				$result = array(

					// draw
					'draw' => $game['id'],

					// home
					'hplayer' => $temp_result['home']['id'],
					'hname' => $temp_result['home']['player'],
					'hlanes' => json_encode($temp_result['home']['lane']),

					'hfull' => sum_lanes('full',$temp_result['home']['lane']),
					'hstop' => sum_lanes('stop',$temp_result['home']['lane']),
					'herror' => sum_lanes('error',$temp_result['home']['lane']),
					'hscore' => sum_lanes('total',$temp_result['home']['lane']),

					'hpoints' => intval($temp_result['home']['points']),

					// visit
					'vplayer' => $temp_result['visit']['id'],
					'vname' => $temp_result['visit']['player'],
					'vlanes' => json_encode($temp_result['visit']['lane']),

					'vfull' => sum_lanes('full',$temp_result['visit']['lane']),
					'vstop' => sum_lanes('stop',$temp_result['visit']['lane']),
					'verror' => sum_lanes('error',$temp_result['visit']['lane']),
					'vscore' => sum_lanes('total',$temp_result['visit']['lane']),

					'vpoints' => intval($temp_result['visit']['points']),

					// diff
					'diff' => intval($temp_result['diff']),

				);

				// insert db result
				db_insert_row('league_results', $result);

			};

		}

		// update team stats
		
		
		// update player stats
		update_league_players();

		return fetch_game('league_draw','cka_id', $id);

	}



	/* 

		AGENDA:
		Agenda functions

	*/

	function fetch_agenda($start = 0, $stop = 1 ) {

		// create agenda
		$agenda = array();

		// connect database
		$db = db_conn();
		
		// day span
		$now = new DateTime();
		// $now->modify('-20 days');
		$begin = $now->modify('-' . $start . ' day')->format('Y-m-d H:i:s');
		$end = $now->modify('+' . $stop + $start . ' day')->format('Y-m-d H:i:s');

		// mkl agenda
		$mkl = array();
		$query =	"SELECT * 
					FROM mkl_draw 
					WHERE datum >= '{$begin}' AND datum < '{$end}'
					ORDER BY datum DESC, daytime DESC";

		if ($sql = $db->query($query)) {
			if(mysqli_num_rows($sql)!=0) {
				
			    /* fetch object array */
			    while ($row = $sql->fetch_array(MYSQLI_ASSOC)) { 
			    	$item = array();
			    	$item = $row;
			   		$item['timestamp'] = strtotime($row['datum'] .' '. $row['daytime']);
			   		$item['mode'] = 'mkl';
			   		$item['data'] = $row;
			   		$item['id'] = $row['draw_id'];
		    		array_push($mkl,$item);
				}
			    /* free result set */
			    $sql->close();
			}

		} else {
			echo("SQL ERROR while loading mkl feed (". $db->errno .'): '. $db->error);
		    return false;
		}

		// mkl reschedule agenda
		$reschedule = array();
		$query =	"SELECT * 
					FROM mkl_draw 
					WHERE reschedule >= '{$begin}' AND reschedule < '{$end}'
					ORDER BY reschedule DESC";

		if ($sql = $db->query($query)) {
			if(mysqli_num_rows($sql)!=0) {
				
			    /* fetch object array */
			    while ($row = $sql->fetch_array(MYSQLI_ASSOC)) { 
			    	$item = array();
			    	$item = $row;
			   		$item['timestamp'] = strtotime($row['reschedule']);
			   		$item['mode'] = 'mkl';
			   		$item['data'] = $row;
			   		$item['id'] = $row['draw_id'];
		    		array_push($reschedule,$item);
				}
			    /* free result set */
			    $sql->close();
			}

		} else {
			echo("SQL ERROR while loading mkl feed (". $db->errno .'): '. $db->error);
		    return false;
		}

		// league agenda
		$league = array();
		$query =	"SELECT * 
					FROM league_draw
					WHERE `date` >= '{$begin}' AND `date` < '{$end}'
					ORDER BY `date` DESC, `time` DESC";

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

			}

		} else {
			echo("SQL ERROR while loading league feed (". $db->errno .'): '. $db->error);
		    return false;
		}


		// concatenate arrays
		$agenda = array_merge($mkl, $reschedule, $league);


		// sort by date and time and return
		$columns = array_column($agenda, 'timestamp');
		array_multisort($columns, SORT_ASC, $agenda);
		// krsort($agenda);
		
		// if(sizeof($agenda) < 1) {
		// 	$agenda = fetch_agenda($stop + 1);
		// }

		// return
		return $agenda;
	}



	/* 

		EVENTS:
		Feed & calendar functions

	*/

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

		SEASON:
		Utils

	*/

	function get_season($mode,$where = null, $id = null) {

		$season = array();

		$season['config'] = db_fetch_row($mode.'_config',$where,$id);

		if($mode == 'mkl') {
			$season['season'] = $season['config']['n_season'];
			$season['year'] = $season['config']['year'];

			$season['teams'] = $season['config']['n_teams'];
			$season['players'] = db_get_count('mkl_players','*',"player_game > 0");
			
			$season['progress'] = array(
				'total' => $season['config']['n_games'],
				'played' => db_get_count($mode.'_draw', 'draw_id', 'played = 1')
			);

			$season['progress']['perc'] = number_format($season['progress']['played'] / $season['progress']['total'] * 100, 1);
		}

		return $season;
	}	


	/* 

		ROUND:
		Fetch

	*/

	function fetch_round($context, $r = 1, $id = null) {

		// init
		$round = array();

		$table = $context . '_draw';

		if($context == 'mkl') {
			$where = "round_id = '{$r}'";
		} else {
			$where = "round = '{$r}'";
		}

		if($id != null) {
			$where .= " AND league = '{$id}'";
		}
		
		// fetch raw game
		$round = db_fetch_rows($table, $where);

		// normalize game

		// return game
		return $round;
	}

	/* 

		ROUND:
		Utils

	*/


	function get_current_mkl_round() {

		// init
		$round = 0;

		$today = date('Y-m-d',time());

		$db = db_conn();

		$query = "SELECT MAX(round_id) as last FROM mkl_draw WHERE played = 1";
		if ($sql = $db->query($query)) {

		    /* fetch object array */
			// $round = $sql->fetch_row()[0] !== null ? $sql->fetch_row()[0] : 1;
			$round = $sql->fetch_row()[0];

		    /* free result set */
		    $sql->close();

		} else {
			echo("SQL ERROR while fetching table element (". $db->errno .'): '. $db->error . '. QUERY: ' . $query);
		    return false;
		}

		return $round;

	}

	function get_current_league_round($id) {

		// init
		$round = 0;

		$today = date('Y-m-d',time());

		$db = db_conn();

		$query = "SELECT MAX(round) as last FROM league_draw WHERE league = '{$id}' AND played = 1";
		if ($sql = $db->query($query)) {

		    /* fetch object array */
			$round = $sql->fetch_row()[0];


		    /* free result set */
		    $sql->close();

		} else {
			echo("SQL ERROR while fetching table element (". $db->errno .'): '. $db->error . '. QUERY: ' . $query);
		    return false;
		}

		return $round;

	}


	/* 

		GAME:
		Fetch

	*/

	function fetch_game($table, $where, $id) {

		// init
		$game = array();
		
		// fetch raw game
		$game = db_fetch_row($table, $where, $id);

		// normalize game

		// return game
		return $game;
	}

	function fetch_league_game($id) {

		return fetch_game('league_draw','id', $id);

	}

	function fetch_league_game_by_cka($id) {

		return fetch_game('league_draw','cka_id', $id);
		
	}

	/* 

		GAME:
		Edits

	*/

	function add_game($add) {

		// insert db result
		if($id = db_insert_row('mkl_draw', $add)) {

			// print('<pre>Game added: ');
			// print_r($add);
			// print('</pre>');

			// fetch data 
			$game = fetch_result($id);
			
		} else {
			return;
		}

	}

	function update_game_draw($update, $id) {

		// update result db entry
		db_update_row('mkl_draw', $update, "draw_id = '{$id}'");

	}

	function update_game($id) {	

		$update = array();
		$results = array();
		$results = db_fetch_rows('mkl_results',"draw_id = '{$id}'");

		if (count($results) > 0) {

			// normalize home and visit
			$pre = array();
			foreach ($results as $temp_result) {
				$pre['home']['score'][] = $temp_result['hfirst'] + $temp_result['hsecond'];
				$pre['home']['error'][] = $temp_result['herror'];
				$pre['home']['plus'] += $temp_result['hpoints'];
				$pre['visit']['score'][] = $temp_result['vfirst'] + $temp_result['vsecond'];
				$pre['visit']['error'][] = $temp_result['verror'];
				$pre['visit']['plus'] += $temp_result['vpoints'];
			}
			
			$h_score = calc_sum($pre['home']['score']);
			$v_score = calc_sum($pre['visit']['score']);

			if ($h_score > $v_score) {
				$pre['home']['plus'] += 2;
			} elseif ($h_score < $v_score) {
				$pre['visit']['plus'] += 2;
			} elseif ($h_score == $v_score) {
				$pre['home']['plus'] += 1;
				$pre['visit']['plus'] += 1;
			}

			$pre['home']['minus'] = $pre['visit']['plus'] ;
			$pre['visit']['minus'] = $pre['home']['plus'] ;

			if ($pre['home']['plus'] > $pre['visit']['plus']) {
				$pre['home']['points'] = 2;
				$pre['visit']['points'] = 0;
			} elseif ($pre['home']['plus'] < $pre['visit']['plus']) {
				$pre['home']['points'] = 0;
				$pre['visit']['points'] = 2;
			} elseif ($pre['home']['plus'] == $pre['visit']['plus']) {
				$pre['home']['points'] = 1;
				$pre['visit']['points'] = 1;
			}

			$update = array(

				'hwins' => $pre['home']['points'] > $pre['visit']['points'] ? 1 : 0,
				'hties' => $pre['home']['points'] == $pre['visit']['points'] ? 1 : 0,
				'hloss' => $pre['home']['points'] < $pre['visit']['points'] ? 1 : 0,
				'hplus' => $pre['home']['plus'],
				'hminus' => $pre['home']['minus'],
				'hscore' => $h_score,
				'hpoints' => $pre['home']['points'],

				'vwins' => $pre['home']['points'] < $pre['visit']['points'] ? 1 : 0,
				'vties' => $pre['home']['points'] == $pre['visit']['points'] ? 1 : 0,
				'vloss' => $pre['home']['points'] > $pre['visit']['points'] ? 1 : 0,
				'vplus' => $pre['visit']['plus'],
				'vminus' => $pre['visit']['minus'],
				'vscore' =>  $v_score,
				'vpoints' => $pre['visit']['points'],

				'played' => 1

			);

		} else {

			$update = array(

				'hwins' => 0,
				'hties' => 0,
				'hloss' => 0,
				'hplus' => 0,
				'hminus' => 0,
				'hscore' => 0,
				'hpoints' => 0,
				'vwins' => 0,
				'vties' => 0,
				'vloss' => 0,
				'vplus' => 0,
				'vminus' => 0,
				'vscore' =>  0,
				'vpoints' => 0,

				'played' => 0

			);

		}
		

		// print('<pre>Game update: ');
		// print_r($update);
		// print('</pre>');

		// update player db entry
		db_update_row('mkl_draw', $update, "draw_id = '{$id}'");

	}

	function delete_game($game_id) {

		// fetch data 
		// $game = fetch_game($game_id);
		// print_r(fetch_results($game_id));

		// remove db result
		if(db_delete_row('mkl_draw', "draw_id = '{$game_id}'")) {

			// remove game results
			if ($results = fetch_results($game_id)) {
				foreach ($results as $r) {
					delete_result($r['result_id']);
				}
			}
			
			// update team tables 
			// update_team($game['hteam_id']);
			// update_team($game['vteam_id']);
			
		} else {
			die("SQL ERROR while deleting game (". $db->errno .'): '. $db->error);
		}


	}


	/* 

		GAME:
		Utility

	*/

	function game_played($id) {

		$played = false;
		
		if(db_fetch_element('league_draw', 'played', "id = '{$id}'") == 1) {
			$played = true;
		} 

		return $played;
	}

	function game_has_results($id) {

		$has = false;
		
		if(db_get_count('league_results', 'id', "draw = '{$id}'") > 0) {
			$has = true;
		} 

		return $has;
	}

	function game_ready($id) {
		return game_played($id) && game_has_results($id) ? true : false;
	}

	function get_game_cka($id) {
		return db_fetch_element('league_draw', 'cka_id', "id = '{$id}'");
	}

	function get_game_from_result($id) {
		return db_fetch_element('mkl_results', 'draw_id', "result_id = '{$id}'");
	}

	function sum_lanes($key,$lanes) {
		$sum = 0;
		foreach ($lanes as $lane) {
			$sum += intval($lane[$key]);
		}
		return $sum;
	}



	/* 

		RESULT:
		Fetch

	*/

	function fetch_result($id) {

		// init
		$result = array();
		
		// fetch raw game
		$result = db_fetch_row('mkl_results', 'result_id', $id);

		// normalize game

		// return game
		return $result;
	}

	function fetch_results($game_id) {

		// init
		$results = array();
		
		// fetch raw game
		$results = db_fetch_rows('mkl_results',"draw_id = '{$game_id}'");

		// normalize game

		// return game
		return $results;
	}

	function fetch_league_results($id) {

		// init
		$results = array();
		
		// fetch raw game
		$results = db_fetch_rows('league_results',"draw = '{$id}'");

		// normalize game

		// return game
		return $results;
	}


	/* 

		RESULT:
		Edits

	*/

	function add_result($add) {

		// insert db result
		if($id = db_insert_row('mkl_results', $add)) {

			// print('<pre>Result added: ');
			// print_r($add);
			// print('</pre>');

			// fetch data 
			$result = fetch_result($id);
			$game = fetch_game('mkl_draw','draw_id',$add['draw_id']);

			// update db game entry
			update_game($game['draw_id']);

			// update tables
			update_tables($result,$game['draw_id']);
			
		} else {
			return;
		}

	}

	function update_result($update, $id) {

		// update result db entry
		db_update_row('mkl_results', $update, "result_id = '{$id}'");

		// print('<pre>Result update: ');
		// print_r($update);
		// print('</pre>');

		// fetch data 
		$result = fetch_result($id);
		// $game = fetch_game('mkl_draw','draw_id',$result['draw_id']);

		// update db game entry
		update_game($result['draw_id']);

		// update tables
		update_tables($result,$result['draw_id']);

	}

	function delete_result($id) {

		// fetch data 
		$result = fetch_result($id);

		// remove db result
		db_delete_row('mkl_results', "result_id = '{$id}'");
		// $game = fetch_game('mkl_draw','draw_id',$result['draw_id']);

		// update db game entry
		update_game($result['draw_id']);

		// update tables
		update_tables($result,$result['draw_id']);

	}

	function update_tables($result, $game_id) {

		// fetch data 
		$game = fetch_game('mkl_draw','draw_id',$game_id);

		// update players
		update_player($result['hplayer_id']);
		update_player($result['vplayer_id']);

		// update team db
		update_team($game['hteam_id']);
		update_team($game['vteam_id']);

	} 

	/* 

		TABLE:
		Fetch

	*/

	function fetch_table($name, $limit = null, $where = null) {

		// init
		$table = array();

		if($where != null) {
			$where = ' AND ' . $where;
		}
		

		switch ($name) {
			case 'mkl_teams':
				# code...
				$order = 'team_total DESC, team_plus DESC, team_avg DESC';
				break;

			case 'mkl_players':
				# code...
				$where = 'player_game > 0' . $where;
				$order = 'player_avg DESC, player_error DESC';
				break;

			case 'league_players':
				# code...
				$where = 'games > 0' . $where;
				$order = 'score DESC, stop DESC';
				break;
			
			default:
				# code...
				break;
		}
		
		// fetch raw table
		$table = db_fetch_table($name, $where, $order, $limit);

		// normalize table

		// return table
		return $table;
	}

	function fetch_league_table($name, $limit = null) {

		// init
		$table = array();

		$where = null;

		switch ($name) {
			case 'mkl_teams':
				# code...
				$order = 'team_total DESC, team_plus DESC, team_avg DESC';
				break;

			case 'mkl_players':
				# code...
				$where = 'player_game > 0';
				$order = 'player_avg DESC, player_error DESC';
				break;
			
			default:
				# code...
				break;
		}
		
		// fetch raw table
		$table = db_fetch_table($name, $where, $order, $limit);

		// normalize table

		// return table
		return $table;
	}

	/* 

		TEAM:
		Edit

	*/

	function update_team($id) {

		$h_results = db_fetch_rows('mkl_draw',"hteam_id = '{$id}' AND played = 1");
		$v_results = db_fetch_rows('mkl_draw',"vteam_id = '{$id}' AND played = 1");

		// normalize home and visit
		$results = array();
		foreach ($h_results as $temp_result) {
			$results['game']++;
			$results['win'][] = $temp_result['hwins'];
			$results['tie'][] = $temp_result['hties'];
			$results['loss'][] = $temp_result['hloss'];
			$results['plus'][] = $temp_result['hplus'];
			$results['minus'][] = $temp_result['hminus'];
			$results['score'][] = $temp_result['hscore'];
			$results['points'] += $temp_result['hpoints'];
		}
		foreach ($v_results as $temp_result) {
			$results['game']++;
			$results['win'][] = $temp_result['vwins'];
			$results['tie'][] = $temp_result['vties'];
			$results['loss'][] = $temp_result['vloss'];
			$results['plus'][] = $temp_result['vplus'];
			$results['minus'][] = $temp_result['vminus'];
			$results['score'][] = $temp_result['vscore'];
			$results['points'] += $temp_result['vpoints'];
		}

		$update = array(
			'team_game' => $results['game'],
			'team_win' => calc_sum($results['win']),
			'team_tie' => calc_sum($results['tie']),
			'team_loss' => calc_sum($results['loss']),
			'team_plus' => calc_sum($results['plus']),
			'team_minus' => calc_sum($results['minus']),
			'team_avg' => calc_avg($results['score']),
			'team_total' => $results['points']
		);

		// print('<pre>Team update: ');
		// print_r($update);
		// print('</pre>');

		// update player db entry
		db_update_row('mkl_teams', $update, "team_id = '{$id}'");

	}


	/* 

		PLAYER:
		Listing

	*/

	function is_active_player($id) {
		return db_get_sum('mkl_players','player_game',"player_id = '{$id}'") > 0;
	}

	function load_players($league, $mode = 'abc', $where = null, $order = null) {

		global $_GLOBAL;

		// init
		$players = array();

		// connect database
		$db = db_conn();

		// query
		$query =	"SELECT * 
					FROM {$league}_players";

		if(!is_null($where)) {
			$query .= " WHERE " . $where;
		}

		if(!is_null($order)) {
			$query .= " ORDER BY " . $order;
		} else {
			$query .= " ORDER BY player_name ASC";
		}


		if ($sql = $db->query($query)) {
			if(mysqli_num_rows($sql)!=0) {
				
			    /* fetch object array */
			    while ($row = $sql->fetch_array(MYSQLI_ASSOC)) { 
			    	$item = $row;
			    	$item['team'] = db_fetch_element('mkl_teams', 'team_name', "team_id = '{$item['roster_id']}'");
			    	$item['active'] = is_active_player($item['player_id']);
			    	
			    	$name = explode(' ', $item['player_name']);
			    	$firstLetter = substr(ucfirst($name[0]), 0, 1); 
			    	$secondLetter = isset($name[1]) ? substr(ucfirst(remove_accent($name[1])), 0, 1) : $firstLetter; 
			    	$item['thumb'] = $firstLetter . $secondLetter;

			    	$item['color'] = $_GLOBAL['colors'][ord($secondLetter) - ord('A') + 1];

			    	switch ($mode) {
			    		case 'abc':
			    			$slug = $firstLetter;
			    			$players[$slug]['label'] = $firstLetter;
			    			break;

			    		case 'team':
			    			$slug = render_slug($item['team']);
			    			$players[$slug]['label'] = $item['team'];
			    			break;

			    		default:
			    			# code...
			    			break;
			    	}
		    		
		    		$players[$slug]['list'][] = $item;

				}
			    /* free result set */
			    $sql->close();

			}

		} else {
			echo("SQL ERROR while loading mkl players (". $db->errno .'): '. $db->error);
		    return false;
		}

		// return
		return $players;
	}

	function fetch_player($league, $id) {

		// init
		$player = array();
		
		// fetch raw player
		$player = db_fetch_row($league.'_players', 'player_id', $id);

		// fetch_player results
		$player['results'] = fetch_player_results('mkl', $id);

		// normalize player

		// return player
		return $player;
	}

	function fetch_player_results($mode, $id) {

		// init
		$results = array();

		if($mode == 'league') {
			
			// connect database
			$db = db_conn();

			$query = "SELECT id, draw,
							 ( SELECT hteam FROM {$mode}_draw WHERE {$mode}_draw.id = {$mode}_results.draw ) AS hteam, 
							 CASE WHEN hplayer = '{$id}' THEN 'home' ELSE 'visit' END AS pos, 
							 CASE WHEN hplayer = '{$id}' THEN hfull ELSE vfull END AS full,
							 CASE WHEN hplayer = '{$id}' THEN hstop ELSE vstop END AS stop, 
							 CASE WHEN hplayer = '{$id}' THEN herror ELSE verror END AS error, 
							 CASE WHEN hplayer = '{$id}' THEN hscore ELSE vscore END AS score, 
							 CASE WHEN hplayer = '{$id}' THEN hpoints ELSE vpoints END AS points 
							 
					 FROM {$mode}_results WHERE hplayer = '{$id}' OR vplayer = '{$id}'";


			if ($sql = $db->query($query)) {

				if(mysqli_num_rows($sql)!=0) {
				    /* fetch object array */
				    while ($row = $sql->fetch_array(MYSQLI_ASSOC)) { 
				    	$results[] = $row;
					}
				}

			    /* free result set */
			    $sql->close();
			
			} else {
				echo("SQL ERROR while fetching table rows (". $db->errno .'): '. $db->error . '. QUERY: ' . $query);
			    return false;
			}

		} else {
			
			// fetch raw game
			$results = db_fetch_rows($mode.'_results', "hplayer_id = '{$id}' OR vplayer_id = '{$id}'");

		}

		// return game
		return $results;

	}


	/* 

		PLAYER:
		Edit

	*/

	function update_player($id) {

		$h_results = db_fetch_rows('mkl_results',"hplayer_id = '{$id}'");
		$v_results = db_fetch_rows('mkl_results',"vplayer_id = '{$id}'");

		// normalize home and visit
		$results = array();
		foreach ($h_results as $temp_result) {
			$results['games']++;
			$results['score'][] = $temp_result['hfirst'] + $temp_result['hsecond'];
			$results['error'][] = $temp_result['herror'];
			$results['points'] += $temp_result['hpoints'];
		}
		foreach ($v_results as $temp_result) {
			$results['games']++;
			$results['score'][] = $temp_result['vfirst'] + $temp_result['vsecond'];
			$results['error'][] = $temp_result['verror'];
			$results['points'] += $temp_result['vpoints'];
		}

		$update = array(
			'player_game' => $results['games'],
			'player_error' => calc_avg($results['error']),
			'player_avg' => calc_avg($results['score']),
			'player_total' => $results['points']
		);

		// print('<pre>Player update: ');
		// print_r($update);
		// print('</pre>');

		// update player db entry
		db_update_row('mkl_players', $update, "player_id = '{$id}'");

	}

	function get_player_lanes($id) {

		$h_results = db_fetch_rows('mkl_results',"hplayer_id = '{$id}'");
		$v_results = db_fetch_rows('mkl_results',"vplayer_id = '{$id}'");

		// normalize home and visit
		$lanes_json = array();
		$lanes = array();
		foreach ($h_results as $temp_result) {
			$lanes_json[] = json_decode($temp_result['hlanes'], true);
		}
		foreach ($v_results as $temp_result) {
			$reverse_lane = json_decode($temp_result['vlanes'], true);
			$lanes_json[] = array_reverse($reverse_lane);
		}


		foreach ($lanes_json as $lane) {
			// full
			$lanes['full'][] = $lane[0]['full'] /*+ $lane[1]['full']*/;
			$lanes['full'][] = $lane[1]['full'];

			// stop
			$lanes['stop'][] = $lane[0]['stop'] /*+ $lane[1]['stop']*/;
			$lanes['stop'][] = $lane[1]['stop'];

			// error
			$lanes['error'][] = $lane[0]['error'] /*+ $lane[1]['error']*/;
			$lanes['error'][] = $lane[1]['error'];

			// total
			$lanes['total'][] = $lane[0]['total'];
			$lanes['total'][] = $lane[1]['total'];

			// first
			$lanes['total_first'][] = $lane[0]['total'];

			// second
			$lanes['total_second'][] = $lane[1]['total'];
		}
	
		$lanes['full_avg'] = calc_avg($lanes['full']);
		$lanes['stop_avg'] = calc_avg($lanes['stop']);
		$lanes['error_avg'] = calc_avg($lanes['error']);
		$lanes['total_avg'] = calc_avg($lanes['total']);
		$lanes['first_avg'] = calc_avg($lanes['total_first']);
		$lanes['second_avg'] = calc_avg($lanes['total_second']);
		
		return $lanes;
	}

	/* 

		PLAYER:
		Batch

	*/

	function update_league_players() {

		$results = db_fetch_table('league_results');
		$players = array();

		foreach ($results as $result) {

			//
			$game = fetch_game('league_draw','id', $result['draw']);
			
			// get club player 
			if(in_array($game['hteam'], array(1, 2, 3))) {
				// home
				$player = array(
					'cka_id' => $result['hplayer'],
					'roster' => $game['hteam'],
					'name' => $result['hname'],
					'games' => 1,
					'full' => $result['hfull'],
					'stop' => $result['hstop'],
					'error' => $result['herror'],
					'score' => $result['hscore'],
					'points' => $result['hpoints'],

				);
				$pos = 'home';

			} elseif (in_array($game['vteam'], array(1, 2, 3))) {
				// visit
				$player = array(	
					'cka_id' => $result['vplayer'],
					'roster' => $game['vteam'],
					'name' => $result['vname'],
					'games' => 1,
					'full' => $result['vfull'],
					'stop' => $result['vstop'],
					'error' => $result['verror'],
					'score' => $result['vscore'],
					'points' => $result['vpoints'],
				);
				$pos = 'visit';
			}

			// test if player already exists
			if(db_get_count('league_players','cka_id',"cka_id = '{$player['cka_id']}'") <= 0) {

				// insert player into db if first start
				db_insert_row('league_players', $player);

			} else {

				// update player stats array

				// search player results
				$players[$player['cka_id']]['id'] = $player['cka_id'];
				$players[$player['cka_id']]['name'] = $player['name'];
				$players[$player['cka_id']]['roster'] = $player['roster'];
				$players[$player['cka_id']]['results'] = fetch_player_results('league', $player['cka_id']);

			}

		}

		// update player stats table
		foreach ($players as $cka_id => $player) {
			$update = array(
				'games' => sizeof($player['results']),
				'roster' => $player['roster'],
				'full' => calc_league_avg('full',$player['results']),
				'stop' => calc_league_avg('stop',$player['results']),
				'error' => calc_league_avg('error',$player['results']),
				'score' => calc_league_avg('score',$player['results']),
				'points' => calc_league_sum('points',$player['results'])
			);

			// update player db entry
			db_update_row('league_players', $update, "cka_id = '{$player['id']}'");
		}


	}

	/* 

		PLAYER:
		Utils

	*/

	function get_player_team($league, $player_id) {

		// init
		$team_id = '';
		
		// fetch raw player
		$team_id = db_fetch_element($league.'_players', 'roster_id', "player_id = '{$player_id}'");

		// return player
		return $team_id;
	}

	/* 

		TEAM:
		Roster

	*/

	function load_roster($id) {

		// init
		$results = array();
		
		// fetch raw game
		$results = db_fetch_rows('mkl_players',"roster_id = '{$id}'");

		// normalize game

		// return game
		return $results;

	}

	function load_teams() {

		// init
		$results = array();
		
		// fetch raw game
		$results = db_fetch_table('mkl_teams');

		// normalize game

		// return game
		return $results;

	}

	function fetch_team($league, $id) {

		// init
		$team = array();
		
		// fetch raw player
		$team = db_fetch_row($league.'_teams', 'team_id', $id);

		// fetch_player results
		$team['games'] = fetch_team_games($league, $id);

		// normalize player

		// return player
		return $team;
	}

	function fetch_team_games($mode, $id) {

		// init
		$results = array();

		if($mode == 'league') {
			
			

		} else {
			
			// fetch raw game
			$results = db_fetch_rows($mode.'_draw', "( hteam_id = '{$id}' OR vteam_id = '{$id}' ) AND played = 1");

		}

		// return game
		return $results;

	}




	function calc_league_avg($key,$array,$pos = 'visit') {
		$avg = array();
		$at_home = 0;
		$h = 0;
		$h_count = 0;
		$v = 0;
		$v_count = 0;
		
		foreach ($array as $item) {
			if(in_array($item['hteam'], array(1, 2, 3))) {
				$h += intval($item[$key]);
				$h_count++;
				$at_home = 1;
			} else {
				$v += intval($item[$key]);
				$v_count++;
			}
		}

		// echo('(' . $v . ' + (' . $h . '/' . $h_count . ') ) / (' .  $v_count . ' + 1 )' ."\n\n");
		
		$avg = number_format( ( $v + ($h / $h_count) ) / ( $v_count + $at_home ), 2);

		return $avg;
	}

	function calc_league_sum($key,$array) {
		$sum = 0;
		foreach ($array as $item) {
			$sum += intval($item[$key]);
		}
		return $sum;
	}

	function calc_sum($array) {
		$sum = 0;

		foreach ($array as $item) {
			$sum += intval($item);
		}

		return $sum;
	}

	function calc_avg($array) {
		$avg = 0.0;

		$avg = number_format( calc_sum($array) / count($array), 3, '.', '');

		return $avg;
	}
	// function to calculate the standard deviation
    // of array elements
    function calc_stdD($arr)
    {
        $num_of_elements = count($arr);
          
        $variance = 0.0;
          
                // calculating mean using array_sum() method
        $average = array_sum($arr)/$num_of_elements;
          
        foreach($arr as $i)
        {
            // sum of squares of differences between 
                        // all numbers and means.
            $variance += pow(($i - $average), 2);
        }
          
        return (float)sqrt($variance/$num_of_elements);
    }

    function calc_variance($arr) {
        $variance = 0.0;
        $totalElementsInArray = count($arr);
        // Calc Mean.
        $averageValue = array_sum($arr) / $totalElementsInArray;

        foreach ($arr as $item) {
            $variance += pow(abs($item - $averageValue), 2);
        }
        
        return $variance;
    }





	/* 

		UTILS:
		Helper functions

	*/

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












	function evalBestPlayerPoints($rr,$id) {
		
		// init allstars points return variable
		$asp = 0;
		
		// loop rounds
		for($r = 1; $r<=$rr; $r++) {		
			
			// build bestplayers array for each round
			$bestplayers = array();
			
			// sql query for results

		  	if ($table = db_fetch_table('mkl_results', "round_id = {$r}")) {

	  			// process entries
	  			foreach ($table as $key => $entry) { 
	  				$bestplayers[$entry['hplayer_id']] = $entry['hfirst']+$entry['hsecond'];
	  				$bestplayers[$entry['vplayer_id']] = $entry['vfirst']+$entry['vsecond'];
	  			}

	  			// sort bestplayers array
	  			arsort($bestplayers,SORT_NUMERIC);
	  			
			}
			
			// find id player in bestplayers array and if found within first four incremet his bestplayers points
			$count = 0; $prev = 0;
			foreach($bestplayers as $pid => $pscore) {
				if($pscore != $prev && $prev !=0) $count++;
				$prev = $pscore;
				if($count > 10) break;
				if($pid == $id) $asp++;
			}	
			
			// unset bestplayers array
			unset($bestplayers);
			
		// loop ends
		}
		
		// return bestplayers points
		return $asp;

	}

	function evalAllstarsPoints($rr,$id) {
		
		// init allstars points return variable
		$asp = 0;
		
		// loop rounds
		for($r = 1; $r<=$rr; $r++) {		
			
			// build allstars array for each round
			$allstars = array();
			
			// sql query for results
		  	if ($table = db_fetch_table('mkl_results', "round_id = {$r}")) {

	  			// process entries
	  			foreach ($table as $key => $entry) { 
	  				$allstars[$entry['hplayer_id']] = $entry['hfirst']+$entry['hsecond'];
	  				$allstars[$entry['vplayer_id']] = $entry['vfirst']+$entry['vsecond'];
	  			}

	  			// sort allstars array
	  			arsort($allstars,SORT_NUMERIC);
	  			
			}
			
			// find id player in allstars array and if found within first four incremet his allstars points
			$count = 0; $prev = 0;
			foreach($allstars as $pid => $pscore) {
				if($pscore != $prev && $prev !=0) $count++;
				$prev = $pscore;
				if($count > 3) break;
				if($pid == $id) $asp++;
			}	
			
			// unset allstars array
			unset($allstars);
			
		// loop ends
		}
		
		// return allstars points
		return $asp;

	} 
	 

	function getNameFromId($mode, $id) 
	{	
		$db = db_conn();
		$query="SELECT {$mode}_name
				FROM mkl_{$mode}s 
				WHERE {$mode}_id = '{$id}'";
				
		if ($sql = $db->query($query)) {

		    /* fetch object array */
		    while ($item = $sql->fetch_array(MYSQLI_ASSOC)) { 

		   		$name = $item[$mode.'_name'];

			}
		    /* free result set */
		    $sql->close();

		} else {
			echo("SQL ERROR while searching mkl matches (". $db->errno .'): '. $db->error);
		    return false;
		}

		return $name;

	}

	function getLeagueFromSlug($slug) 
	{	
		$db = db_conn();
		$query="SELECT id as result
				FROM league_config 
				WHERE slug = '{$slug}'";
				
		if ($sql = $db->query($query)) {

		    /* fetch object array */
		    while ($item = $sql->fetch_array(MYSQLI_ASSOC)) { 

		   		$result = $item['result'];

			}
		    /* free result set */
		    $sql->close();

		} else {
			echo("SQL ERROR while searching name (". $db->errno .'): '. $db->error);
		    return false;
		}

		return $result;

	}

	function getLeague($id) 
	{	
		$db = db_conn();
		$query="SELECT name as result
				FROM league_config 
				WHERE id = '{$id}'";
				
		if ($sql = $db->query($query)) {

		    /* fetch object array */
		    while ($item = $sql->fetch_array(MYSQLI_ASSOC)) { 

		   		$result = $item['result'];

			}
		    /* free result set */
		    $sql->close();

		} else {
			echo("SQL ERROR while searching name (". $db->errno .'): '. $db->error);
		    return false;
		}

		return $result;

	}

	function getLeagueSlug($id) 
	{	
		$db = db_conn();
		$query="SELECT slug as result
				FROM league_config 
				WHERE id = '{$id}'";
				
		if ($sql = $db->query($query)) {

		    /* fetch object array */
		    while ($item = $sql->fetch_array(MYSQLI_ASSOC)) { 

		   		$result = $item['result'];

			}
		    /* free result set */
		    $sql->close();

		} else {
			echo("SQL ERROR while searching name (". $db->errno .'): '. $db->error);
		    return false;
		}

		return $result;

	}
	function getLeagueShort($id) 
	{	
		$db = db_conn();
		$query="SELECT short as result
				FROM league_config 
				WHERE id = '{$id}'";
				
		if ($sql = $db->query($query)) {

		    /* fetch object array */
		    while ($item = $sql->fetch_array(MYSQLI_ASSOC)) { 

		   		$result = $item['result'];

			}
		    /* free result set */
		    $sql->close();

		} else {
			echo("SQL ERROR while searching name (". $db->errno .'): '. $db->error);
		    return false;
		}

		return $result;

	}
	function getLeagueNameFromId($mode, $id) 
	{	
		$db = db_conn();
		$query="SELECT name, short
				FROM league_{$mode}s 
				WHERE id = '{$id}'";
				
		if ($sql = $db->query($query)) {

		    /* fetch object array */
		    while ($item = $sql->fetch_array(MYSQLI_ASSOC)) { 

		   		$name = $item['short'];

			}
		    /* free result set */
		    $sql->close();

		} else {
			echo("SQL ERROR while searching name (". $db->errno .'): '. $db->error);
		    return false;
		}

		return $name;

	}

	

	

	// round functions
	function loadMklRound($round = 1) {

		$games = array();
		$db = db_conn();
		$query=		"SELECT * 
					FROM mkl_draw 
					WHERE round_id = {$round} 
					ORDER BY datum ASC, daytime ASC";

		if ($sql = $db->query($query)) {
			if(mysqli_num_rows($sql)!=0) {
				
			    /* fetch object array */
			    while ($item = $sql->fetch_array(MYSQLI_ASSOC)) { 

			   		$item['league'] = 'mkl';
		    		array_push($games,$item);

				}
			    /* free result set */
			    $sql->close();

			}

		} else {
			echo("SQL ERROR while loading mkl round (". $db->errno .'): '. $db->error);
		    return false;
		}

		// normalize dates
		foreach ($games as $key => $game) {
			if(isset($game['datum'])) {
			  $games[$key]['date'] = $game['datum'];
			  unset($games[$key]['datum']);
			}
			if(isset($game['daytime'])) {
			  $games[$key]['time'] = $game['daytime'];
			  unset($games[$key]['daytime']);
			}
		}

		return $games;

	}

	// game functions

	function loadGame($mode,$id) {

		// databse connection
		$db = db_conn();

		$game = array();

		$query="SELECT *
				FROM {$mode}_draw 
				WHERE draw_id = '{$id}'";
				
		if ($sql = $db->query($query)) {

		    /* fetch object array */
		    while ($item = $sql->fetch_array(MYSQLI_ASSOC)) { 

		   		$game = $item;

		   		$results = array();

		   		$query="SELECT *
		   				FROM {$mode}_results 
		   				WHERE draw_id = '{$id}'
		   				ORDER BY result_id ASC";
		   				
		   		if ($sql = $db->query($query)) {

		   		    /* fetch object array */
		   		    while ($item = $sql->fetch_array(MYSQLI_ASSOC)) { 

		   		   		array_push($results,$item);

		   			}

		   			$game['results'] = $results;


		   		} else {
		   			echo("SQL ERROR while loading game results (". $db->errno .'): '. $db->error);
		   		    return false;
		   		}

			}
		    /* free result set */
		    $sql->close();

		} else {
			echo("SQL ERROR while loading game (". $db->errno .'): '. $db->error);
		    return false;
		}


		return $game;

	}

	function loadResult($league,$matchId) {

		// databse connection
		require("_sql_conn.php");

		$results = array();

		$query="select * from ".$league."_results where draw_id = ".$matchId." order by result_id asc";

		if ($sql = $mysqli->query($query)) {

		  /* fetch object array */
		  while ($item = $sql->fetch_array()) { 

			  array_push($results,$item);

			}

		  /* free result set */
		  $sql->close();
		}

		return $results;

	}


function str_contains_any($string, $words, $caseSensitive = true) {
    foreach ($words as $word) {
        $position = $caseSensitive ? stripos($string, $word) : strpos($string, $word);
    
        if ($position !== false) {
            return true;
        }
    }
    
    return false;
}


function icsToArray($paramUrl){
    $icsFile = file_get_contents($paramUrl);

    $icsData = explode("BEGIN:", $icsFile);

    foreach($icsData as $key => $value){
        $icsDatesMeta[$key] = explode("\n", $value);
    }

    foreach($icsDatesMeta as $key => $value){
        foreach($value as $subKey => $subValue){
            if($subValue != ""){
                if($key != 0 && $subKey == 0){
                    $icsDates[$key]["BEGIN"] = trim($subValue);
                }else{
                    $subValueArr = explode(":", $subValue, 2);
                    $subValueArrKey = explode(";",$subValueArr[0]);
                    $icsDates[$key][$subValueArrKey[0]] = trim($subValueArr[1]);
                }
            }
        }
    }

    return $icsDates;
}

function tag_ical_events($ievent) {
	$tag = '';

    if(str_contains($ievent['SUMMARY'], 'Dorost') || str_contains_any($ievent['LOCATION'], ['DOROST','ZACI'])) {
    	$tag = 'league dorost';
    } else if(str_contains_any($ievent['SUMMARY'], ['Svitavy A','Svitavy B']) || str_contains_any($ievent['LOCATION'], ['SYA','SYB']) ) {
    	$tag = 'league vcp';
    } else if(str_contains($ievent['SUMMARY'], 'Svitavy C') || str_contains_any($ievent['LOCATION'], ['SYC'])) {
    	$tag = 'league vcs';
	} else if(str_contains_any($ievent['SUMMARY'], ['Turnaj','turnaj','Pohár','SY200']) || str_contains_any($ievent['LOCATION'], ['TURNAJ','POHAR'])) {
    	$tag = 'tournament';
    } else if(str_contains_any($ievent['SUMMARY'], ['Akce','koncert']) || str_contains_any($ievent['LOCATION'], ['AKCE','KONCERT'])) {
    	$tag = 'public';
    } else if(str_contains($ievent['SUMMARY'], 'MKL') || str_contains_any($ievent['LOCATION'], ['MKL'])) {
    	$tag = 'mkl';
    } else {
    	$tag = 'other';
    }

    return $tag;
}
function fetch_ical_events($ics,$now,$limit = false) {


	$events = array();

	// $first_day = date('N',strtotime($now));
	// $last_day =  date('t',strtotime($now));
	$first_date = date("Y-m-01", strtotime($now));
	$last_date = date("Y-m-t", strtotime($now));

	if ($limit) {
		$first_date = date("Y-m-d", strtotime($now));
		$last_date = date("Y-m-d", strtotime($now . '+1 day'));
	}

	// find month events
	foreach($ics as $a){

	    if($a['BEGIN'] == "VEVENT" && !isset($a['RECURRENCE-ID']) && ( strtotime($first_date) <= strtotime($a['DTSTART']) && strtotime($a['DTSTART']) <= strtotime($last_date) ) ) {
	    	$id = $a['LAST-MODIFIED'];
	    	$a['DTSTART'] = isset($a['DTSTART;TZID=Europe/Prague']) ? $a['DTSTART;TZID=Europe/Prague'] : $a['DTSTART'];
	    	$a['DTEND'] = isset($a['DTEND;TZID=Europe/Prague']) ? $a['DTEND;TZID=Europe/Prague'] : $a['DTEND'];
    	    $events[$id]['timestamp'] = strtotime($a['DTSTART']);
	        $events[$id]['start_date'] = date("Y-m-d", strtotime($a['DTSTART']));
	        $events[$id]['start_time'] = date("G:i", strtotime($a['DTSTART']));
	        $events[$id]['end_date'] = date("Y-m-d", strtotime($a['DTEND']));
	        $events[$id]['end_time'] = date("G:i", strtotime($a['DTEND']));
        	$events[$id]['summary'] = $a['SUMMARY'];
        	$events[$id]['desc'] = $a['DESCRIPTION'];
        	$events[$id]['ics'] = $a;
        	$events[$id]['span'] = 1;
        	$events[$id]['fullday'] = 0;
        	$events[$id]['recurrent'] = 0;
	        $events[$id]['category'] = tag_ical_events($a);
	    }
	}

	// find full day events
	$fullday = array();
	foreach($ics as $a){

	    if($a['BEGIN'] == "VEVENT" && date('Y-m-d',strtotime($a['DTSTART'])) != date('Y-m-d',strtotime($a['DTEND'])) ) {
	    	$id = $a['LAST-MODIFIED'];
	    	$span = (strtotime($a['DTEND']) - strtotime($a['DTSTART']))/60/60/24;
	    	$a['DTSTART'] = isset($a['DTSTART;TZID=Europe/Prague']) ? $a['DTSTART;TZID=Europe/Prague'] : $a['DTSTART'];
	    	$a['DTEND'] = isset($a['DTEND;TZID=Europe/Prague']) ? $a['DTEND;TZID=Europe/Prague'] : $a['DTEND'];
    	    $fullday[$id]['timestamp'] = strtotime($a['DTSTART']);
	        $fullday[$id]['start_date'] = date("Y-m-d", strtotime($a['DTSTART']));
	        $fullday[$id]['start_time'] = date("G:i", strtotime($a['DTSTART']));
	        $fullday[$id]['end_date'] = date("Y-m-d", strtotime($a['DTEND']));
	        $fullday[$id]['end_time'] = '23:59';
        	$fullday[$id]['summary'] = $a['SUMMARY'];
        	$fullday[$id]['desc'] = $a['DESCRIPTION'];
        	$fullday[$id]['ics'] = $a;
        	$fullday[$id]['span'] = $span;
        	$fullday[$id]['fullday'] = 1;
        	$fullday[$id]['recurrent'] = 0;
	        $fullday[$id]['category'] = tag_ical_events($a);
	    }
	}

	// add fullday
	foreach ($fullday as $key => $fevent) {

		
		// // get event spanning days
		// $fmonth = array();

		// for ($i=1; $i<=$fevent['span']; $i++) {
		// 	$fmonth[] = date("Y-m-d", strtotime($fevent['start_date'] . '+' . $i . ' days'));
		// }
		// // add spanning instances
		// foreach ($fmonth as $fday) {
		// 	// echo $fday;
		// $id = $fevent['LAST-MODIFIED'].$fevent['ics']['DTSTART'];
		if ($limit) {
			# code...
			if( strtotime($first_date) >= strtotime($fevent['start_date']) && strtotime($first_date) <= strtotime($fevent['end_date']) ) {
				$events[$id] = $fevent;
			}
		} else {
			if( strtotime($fevent['start_date']) >= strtotime($first_date) && strtotime($last_date) >= strtotime($fevent['end_date']) ) {
				$events[$id] = $fevent;
			}
		}
		// 		$events[$id] = $fevent;
		// 		$events[$id]['timestamp'] = strtotime($fday);
				
		// 		$events[$id]['start_date'] = date("Y-m-d", strtotime($fday));
		// 		$events[$id]['end_date'] = date("Y-m-d", strtotime($fday));
		// 		// $events[$id]['category'] = 'other';
			
		// }

	} 	

	// find recurring events
	$recurrent = array();
	foreach($ics as $a){
	    if($a['BEGIN'] == "VEVENT" && isset($a['RRULE'])){
	    	$rules = array();
	    	foreach (explode(";",$a['RRULE']) as $i => $rule) {
	    		$rule = explode("=",$rule);
	    		$rules[$rule[0]] = $rule[1];
	    	}
	    	$id = $a['LAST-MODIFIED'];
	    	$recurrent[$id]['timestamp'] = strtotime($a['DTSTART']);
	    	$recurrent[$id]['start_date'] = date("Y-m-d", strtotime($a['DTSTART']));
	        $recurrent[$id]['start_time'] = date("G:i", strtotime($a['DTSTART']));
	        $recurrent[$id]['end_date'] = date("Y-m-d", strtotime($a['DTEND']));
	        $recurrent[$id]['end_time'] = date("G:i", strtotime($a['DTEND']));
	        $recurrent[$id]['until'] = date("Y-m-d", strtotime($rules['UNTIL']));
	        $recurrent[$id]['expires'] = date("Y-m-d", strtotime($a['EXDATE']));
	        $recurrent[$id]['rules'] = $rules;
	        $recurrent[$id]['summary'] = $a['SUMMARY'];
	        $recurrent[$id]['desc'] = $a['DESCRIPTION'];
        	$recurrent[$id]['ics'] = $a;
        	$recurrent[$id]['span'] = 1;
        	$recurrent[$id]['fullday'] = 0;
        	$recurrent[$id]['recurrent'] = 1;
        	$recurrent[$id]['category'] = tag_ical_events($a);
	    }
	}
	// echo '<pre>';
	// print_r($recurrent);
	// echo '</pre>';

	// add recurring
	foreach ($recurrent as $key => $fevent) {

		if ((!isset($fevent['rules']['UNTIL']) || strtotime($fevent['until']) > strtotime($now)) && $fevent['rules']['FREQ'] == 'WEEKLY' ) {
			$day = $fevent['rules']['BYDAY'];

			// get recurrent days
			$rmonth = getDaysInMonth(date("Y", strtotime($now)),date("m", strtotime($now)),3);

			// add recurrent instances
			foreach ($rmonth as $rday) {
				if( strtotime($first_date) <= strtotime($rday) && strtotime($rday) < strtotime($last_date) ) {
					$id = $fevent['LAST-MODIFIED'].$fevent['ics']['DTSTART'].$rday;
					$events[$id] = $fevent;
					$events[$id]['timestamp'] = strtotime($rday . ' ' .$fevent['start_time']);
					$events[$id]['start_date'] = date("Y-m-d", strtotime($rday));
					$events[$id]['end_date'] = date("Y-m-d", strtotime($rday));
				}
				// add to calendar
				// $calendar->add_event($event['summary'], $event['start_date'], 1, $event['category']);
			}
		}	

	} 	

	// sort events 
	$columns = array_column($events, 'timestamp');
	array_multisort($columns, $order == 'DESC' ? SORT_DESC : SORT_ASC, $events);

	return $events;
}

function getDaysInMonth($y,$m,$d){ 
    $date = "$y-$m-01";
    $first_day = date('N',strtotime($date));
    $first_day = 7 - $first_day + $d;
    $last_day =  date('t',strtotime($date));
    $days = array();
    for($i=$first_day; $i<=$last_day; $i=$i+7 ){
        $days[] = date('Y-m-d', strtotime("$y-$m-".$i));
    }
    return  $days;
}

class Calendar {
	

    private $active_year, $active_month, $active_day;
    private $events = [];

    public function __construct($date = null) {
        $this->active_year = $date != null ? date('Y', strtotime($date)) : date('Y');
        $this->active_month = $date != null ? date('m', strtotime($date)) : date('m');
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
        $html = '<div class="calendar">';
        $html .= '<div class="header">';
        $html .= '<h2 class="month-year">';
        $month_num = date('n', strtotime($this->active_year . '-' . $this->active_month . '-' . $this->active_day));
        $html .= mb_ucfirst($_GLOBAL['czmonth'][$month_num]) .' '. $this->active_year;
        $html .= '</h2>';
        $html .= '</div>';
        $html .= '<div class="days">';
        foreach ($days_cz as $day) {
            $html .= '
                <div class="day_name">	
                    <span class="label --dimm">' . $day . '</span>
                </div>
            ';
        }
        for ($i = $first_day_of_week; $i > 0; $i--) {
            $html .= '
                <div class="day_num ignore">
                    ' . ($num_days_last_month-$i+1) . '
                </div>
            ';
        }
        for ($i = 1; $i <= $num_days; $i++) {
            $selected = '';
           
            if (date("Y-m-d", time()) == date('Y-m-d', strtotime( $this->active_year .'-'. $this->active_month .'-'. $i ))) {
                $selected = ' selected';
            }
            $html .= '<a href="klub/kalendar/' .($this->active_year .'-'. $this->active_month .'-'. $i). '" data-modal-open="calendar"  class="day_num ' . $selected . '" data-loader-control data-loader-child>';
            $html .= '<h4 class="label"><span>' . $i . '</span></h4>';
            $html .= '<div class="event__list">';
            foreach ($this->events as $event) {
                for ($d = 0; $d <= ($event[2]-1); $d++) {
                	$first = $d == 0 ? ' --first' : '';
                	$last = $d == $event[2]-1 ? ' --last' : '';
                    if (date('y-m-d', strtotime($this->active_year . '-' . $this->active_month . '-' . $i . ' -' . $d . ' day')) == date('y-m-d', strtotime($event[1]))) {
                    	$html .= $event[4] ? '<span class="event --spacer"></span>' : '';
                        $html .= '<div data-event="'. $event[3]. '" class="event ' . $event[3] . ' ' . $event[4] . $first . $last . '" >';
                        $html .= '<span class="event__label">'.$event[0].'</span>';
                        $html .= '</div>';
                    }
                }
            }
            $html .= '</div>';
            $html .= file_get_contents($relpath.'template/component/loader.php');
            $html .= '</a>';
        }
        for ($i = 1; $i <= (42-$num_days-max($first_day_of_week, 0)); $i++) {
            $html .= '
                <div class="day_num ignore">
                    ' . $i . '
                </div>
            ';
        }
        $html .= '</div>';
        $html .= '</div>';
        return $html;
    }

}
