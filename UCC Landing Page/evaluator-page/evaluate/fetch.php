<?php
include('db.php');

$column = array("FG1");
$query = "SELECT * FROM students";

    if(isset($_POST["search"]["value"]))
    {
        $query .= '
        WHERE MT1 LIKE %'.$_POST["search"]["value"].'%"';
    }

    if(isset($_POST["order"]))
    {
        $query .= 'ORDER BY '.$column[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' ';
    }
    else{
        $query .= 'ORDER BY id DESC ';
    }

    $query1 = '';

    if($_POST["length"] != -1)
    {
        $query1 = 'LIMIT' .$_POST['start'].','.$_POST['length'];
    }

    $statement = $con->prepare($query);
    $statement->execute();

    $number_filter_row = $statement->num_rows();
    $result = $con->query($query.$query1);
    $data = array();

    foreach($result as $row)
    {
        $sub_array = array();
        $sub_array[] = $row['id'];
        $sub_array[] = $row['MT1'];
        $sub_array[] = $row['FT1'];
        $data[] = $sub_array;
    }

    function count_all_data($con)
    {
        $query = "SELECT * FROM students";
        $statement = $con->prepare($query);
        $statement->execute();
        return $statement->num_rows();
    }

    $output = array(
        'draw' => intval($_POST['draw']),
        'recordsTotal' => count_all_data($con),
        'recordsFiltered' => $number_filter_row,
        'data' => $data
    );

    echo json_encode($output);

?>