<?php
/* graph.php */
	//connect to db
	session_start();
	include('db.php');

	
		$local_user_email = $_SESSION['USEREMAIL'];
		//echo "lo.$local_user_email";

		$countQuery = mysql_query("SELECT COUNT(*) AS CNT FROM work_week WHERE email = '$local_user_email' ");
		while($countRow = mysql_fetch_row($countQuery))
		{
			if($countRow[0] > 0)
			{
				
				$infoQuery = mysql_query("SELECT seven, six, five, four, three, two, one FROM work_week WHERE email = '$local_user_email' ");
				while($row = mysql_fetch_row($infoQuery))
				{	
					$w_seven = $row[0];
					$w_six = $row[1];
					$w_five = $row[2];
					$w_four = $row[3];
					$w_three = $row[4];
					$w_two = $row[5];
					$w_one = $row[6];
				}
			}
			
		}


		$countQuery = mysql_query("SELECT COUNT(*) AS CNT FROM break_week WHERE email = '$local_user_email' ");
		while($countRow = mysql_fetch_row($countQuery))
		{
			if($countRow[0] > 0)
			{
				
				$infoQuery = mysql_query("SELECT seven, six, five, four, three, two, one FROM break_week WHERE email = '$local_user_email' ");
				while($row = mysql_fetch_row($infoQuery))
				{	
					$b_seven = $row[0];
					$b_six = $row[1];
					$b_five = $row[2];
					$b_four = $row[3];
					$b_three = $row[4];
					$b_two = $row[5];
					$b_one = $row[6];
				}
			}
			
		}

		// $countQuery = mysql_query("SELECT COUNT(*) AS CNT FROM mana_week WHERE email = '$local_user_email' ");
		// while($countRow = mysql_fetch_row($countQuery))
		// {
		// 	if($countRow[0] > 0)
		// 	{
				
		// 		$infoQuery = mysql_query("SELECT seven, six, five, four, three, two, one FROM mana_week WHERE email = '$local_user_email' ");
		// 		while($row = mysql_fetch_row($infoQuery))
		// 		{	
		// 			$m_seven = $row[0];
		// 			$m_six = $row[1];
		// 			$m_five = $row[2];
		// 			$m_four = $row[3];
		// 			$m_three = $row[4];
		// 			$m_two = $row[5];
		// 			$m_one = $row[6];
		// 		}
		// 	}
			
		// }

		$pi_seven = CalculatePI($b_seven, $w_seven);
		$pi_six = CalculatePI($b_six, $w_six);
		$pi_five = CalculatePI($b_five, $w_five);
		$pi_four = CalculatePI($b_four, $w_four);
		$pi_three = CalculatePI($b_three, $w_three);
		$pi_two = CalculatePI($b_two, $w_two);
		$pi_one = CalculatePI($b_one, $w_one);

		function CalculatePI($b, $w)
		{
			if($w < 1.0)
				return 0;
			else
				return round((float)($b/$w), 2);
		}
		
		//echo "7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 11.0, 20.0, 11.0, 14.0, 18.0, 7.0, 13.7";
		//echo "$w_seven, $w_six, $w_five, $w_four, $w_three, $w_two, $w_one, $b_seven, $b_six, $b_five, $b_four, $b_three, $b_two, $b_one, $m_seven, $m_six, $m_five, $m_four, $m_three, $m_two, $m_one";
		echo "$w_seven, $w_six, $w_five, $w_four, $w_three, $w_two, $w_one, $b_seven, $b_six, $b_five, $b_four, $b_three, $b_two, $b_one, $pi_seven, $pi_six, $pi_five, $pi_four, $pi_three, $pi_two, $pi_one";
?>