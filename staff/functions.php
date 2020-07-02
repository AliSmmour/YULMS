<?php
if (empty($_SESSION))
{
session_start();
}
/*
 * Function requested by Ajax
 */
if(isset($_POST['func']) && !empty($_POST['func'])){
	switch($_POST['func']){
		case 'getCalender':
			getCalender($_POST['year'],$_POST['month']);
			break;
		default:
			break;
	}
}

/*
 * Get calendar full HTML
 */
function getCalender($year = '',$month = '')
{
	$staff_id=$_SESSION['staff_ID'];
	$dateYear = ($year != '')?$year:date("Y");
	$dateMonth = ($month != '')?$month:date("m");
	$date = $dateYear.'-'.$dateMonth.'-01';
	$currentMonthFirstDay = date("N",strtotime($date));
	$totalDaysOfMonth = cal_days_in_month(CAL_GREGORIAN,$dateMonth,$dateYear);
	$totalDaysOfMonthDisplay = ($currentMonthFirstDay == 7)?($totalDaysOfMonth):($totalDaysOfMonth + $currentMonthFirstDay);
	$boxDisplay = ($totalDaysOfMonthDisplay <= 35)?35:42;
?>
	<div id="calender_section">
		<h2>
        	<a href="javascript:void(0);" onclick="getCalendar('calendar_div','<?php echo date("Y",strtotime($date.' - 1 Month')); ?>','<?php echo date("m",strtotime($date.' - 1 Month')); ?>');">&lt;&lt;</a>
            <select name="month_dropdown" class="month_dropdown dropdown"><?php echo getAllMonths($dateMonth); ?></select>
			<select name="year_dropdown" class="year_dropdown dropdown"><?php echo getYearList($dateYear); ?></select>
            <a href="javascript:void(0);" onclick="getCalendar('calendar_div','<?php echo date("Y",strtotime($date.' + 1 Month')); ?>','<?php echo date("m",strtotime($date.' + 1 Month')); ?>');">&gt;&gt;</a>
        </h2>
		<div id="event_list" class="none"></div>
		<div id="calender_section_top">
			<ul>
				<li>Sun</li>
				<li>Mon</li>
				<li>Tue</li>
				<li>Wed</li>
				<li>Thu</li>
				<li>Fri</li>
				<li>Sat</li>
			</ul>
		</div>
		<div id="calender_section_bot">
			<ul>
			<?php 
				$dayCount = 1; 
				for($cb=1;$cb<=$boxDisplay;$cb++){
					if(($cb >= $currentMonthFirstDay+1 || $currentMonthFirstDay == 7) && $cb <= ($totalDaysOfMonthDisplay)){
						//Current date
						$currentDate = $dateYear.'-'.$dateMonth.'-'.$dayCount;
						$eventNum = 0;
						//Include db configuration file
						include 'connect.php';
						//Get number of events based on the current date
						$sql= "(SELECT course_name  , course_time FROM course_table Where staff_id=".$staff_id." and course_status=1 and         course_date = '".$currentDate."')
							UNION
							(SELECT course_name  , course_time FROM course_table crs , take_relation tr  Where crs.course_id=tr.course_id and tr.staff_id=".$staff_id."  and course_status=1 and course_date = '".$currentDate."')
							ORDER BY course_time ASC";
						$result = mysqli_query($conn,$sql);
						$eventNum =mysqli_num_rows($result);
						//Define date cell color
						if(strtotime($currentDate) == strtotime(date("Y-m-d"))){
							echo '<li date="'.$currentDate.'" class="grey date_cell">';
						}elseif($eventNum > 0){
							echo '<li date="'.$currentDate.'" class="light_green date_cell"  data-toggle="popover" title="Event ('.$eventNum.')" data-html="true" data-content="';
							// Popover Content 
							$sql="(SELECT course_name  , course_time FROM course_table Where staff_id=".$staff_id." and course_status=1 and         course_date = '".$currentDate."')
							UNION
							(SELECT course_name  , course_time FROM course_table crs , take_relation tr  Where crs.course_id=tr.course_id and tr.staff_id=".$staff_id."  and course_status=1 and course_date = '".$currentDate."')
							ORDER BY course_time ASC";
								$result = mysqli_query($conn,$sql) ;
								$Ec=1; 
								while($row = mysqli_fetch_assoc($result)){ 
 								echo '<b>'.$Ec.'. '.$row['course_time'].'  '.$row['course_name'].'</b><br>';
 								$Ec++ ;
 								}

							echo ' " data-trigger="hover" data-placement="auto"> ';
							// Cell Content 
							$sql="(SELECT course_name  , course_time FROM course_table Where staff_id=".$staff_id." and course_status=1 and         course_date = '".$currentDate."')
							UNION
							(SELECT course_name  , course_time FROM course_table crs , take_relation tr  Where crs.course_id=tr.course_id and tr.staff_id=".$staff_id."  and course_status=1 and course_date = '".$currentDate."')
							ORDER BY course_time ASC";
								$result = mysqli_query($conn,$sql) ;
								$Ec=1; 
								while($row = mysqli_fetch_assoc($result)){ 
 								echo '<div class="eve">'.$Ec.' - '.$row['course_name'].'</div>';
 								$Ec++ ;
 								}

						}else{
							echo '<li date="'.$currentDate.'" class="date_cell">';
						}
						
						echo '<span>';
						echo $dayCount;
						echo '</span>';						
						echo '</li>';
						$dayCount++;
			?>
			<?php }else{ ?>
				<li><span>&nbsp;</span></li>
			<?php } } ?>
			</ul>
		</div>
	</div>
	<script type="text/javascript">
		$(document).ready(function(){
						$('[data-toggle="popover"]').popover();
						
					});
					
	</script>
	<script type="text/javascript">
		function getCalendar(target_div,year,month){
			$.ajax({
				type:'POST',
				url:'functions.php',
				data:'func=getCalender&year='+year+'&month='+month,
				success:function(html){
					$('#'+target_div).html(html);
				}
			});
		}
		
		
		
		
		$(document).ready(function(){
			$('.date_cell').mouseenter(function(){
				date = $(this).attr('date');
				$(".date_popup_wrap").fadeOut();
				$("#date_popup_"+date).fadeIn();	
			});
			$('.date_cell').mouseleave(function(){
				$(".date_popup_wrap").fadeOut();		
			});
			$('.month_dropdown').on('change',function(){
				getCalendar('calendar_div',$('.year_dropdown').val(),$('.month_dropdown').val());
			});
			$('.year_dropdown').on('change',function(){
				getCalendar('calendar_div',$('.year_dropdown').val(),$('.month_dropdown').val());
			});
			$(document).click(function(){
				$('#event_list').slideUp('slow');
			});
		});
	</script>
<?php
}

/*
 * Get months options list.
 */
function getAllMonths($selected = ''){
	$options = '';
	for($i=1;$i<=12;$i++)
	{
		$value = ($i < 10)?'0'.$i:$i;
		$selectedOpt = ($value == $selected)?'selected':'';
		$options .= '<option value="'.$value.'" '.$selectedOpt.' >'.date("F", mktime(0, 0, 0, $i+1, 0, 0)).'</option>';
	}
	return $options;
}

/*
 * Get years options list.
 */
function getYearList($selected = ''){
	$options = '';
	for($i=2015;$i<=2025;$i++)
	{
		$selectedOpt = ($i == $selected)?'selected':'';
		$options .= '<option value="'.$i.'" '.$selectedOpt.' >'.$i.'</option>';
	}
	return $options;
}

/*
 * Get events by date
 */

?>