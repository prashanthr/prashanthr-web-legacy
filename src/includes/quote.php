<?php
/* Snippet to Display Quotes on Website - Prashanth R */
					$quote_count_query = mysql_query("SELECT COUNT(*) FROM quotes");
					$row = mysql_fetch_row($quote_count_query);
					$count = $row[0];
					
					$selected_quote = rand(1, $count);
					$quote_query = mysql_query("SELECT quote,author FROM quotes WHERE id=$selected_quote");
					$row = mysql_fetch_row($quote_query);
					$quote = $row[0];
					$author = $row[1];					
?>
<p><blockquote id="quote" class="circle">&quot;<?php echo $quote; ?>&quot; - <?php echo $author; ?>&nbsp;&nbsp;&nbsp;&nbsp;<a href='' class='ten'><img src="../images/icons/refreshicon.png" height="18px" width="18px" border="none"/></a></blockquote></p>