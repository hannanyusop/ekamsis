
<!DOCTYPE html>
<html lang="en">

<?php include_once('../permission_staff.php') ?>
<?php

    if($_GET['id']){

        $q_block = $db->query("SELECT * FROM blocks WHERE id=$_GET[id]");

        $block = $q_block->fetch_assoc();

        if(!$block){
            echo "<script>alert('Block not exist!');window.location='data-block.php';</script>";
            exit();
        }

        $floors = json_decode($block['floor_list']);

        if(isset($_POST['form'])){

            if($_POST['form'] == "add-room"){

                $name = strtoupper($_POST['name']);
                $q = "INSERT INTO rooms (block_id, floor, is_active, name) VALUES ('$block[id]', '$_POST[floor]', 1, '$name')";

                if (!$db->query($q)) {
                    echo "<script>alert('Failed to insert new room.');window.location='data-room.php?id=".$_GET['id']."'</script>";
                    exit();
                }else{
                    echo "<script>alert('New session successfully inserted!');window.location='data-room.php?id=".$_GET['id']."'</script>";
                }
            }

            if($_POST['form'] == "add-sub-room"){

                $name = strtoupper($_POST['code']);

                $inventories = $_POST['inventory_id'];

                $q = "INSERT INTO room_subs (room_id, code, is_active) VALUES ('$_POST[room_id]', '$_POST[code]', 1)";

                if (!$db->query($q)) {

                    dd($db->error);
                    $_POST = array();
                    echo "<script>alert('Failed to insert new sub room.');window.location='data-room.php?id=".$_GET['id']."'</script>";
                }else{


                    $room_sub_id = $db->insert_id;
                    foreach ($inventories as $inventory_id){

                        try {

                            $q_room_sub = "INSERT INTO room_sub_inventories (room_sub_id, inventory_id, remark) VALUES ($room_sub_id, $inventory_id, '')";
                            $db->query($q_room_sub);

                        }catch (Exception $e){

                            $_POST = array();
                            dd($e);
                        }
                    }

                    $_POST = array();
                    echo "<script>alert('New Sub room successfully inserted!');window.location='data-room.php?id=".$_GET['id']."'</script>";
                }
            }
        }

        $q_inventories = $db->query("SELECT * FROM inventories WHERE is_active=1");

        $r_rooms = $db->query("SELECT * FROM rooms WHERE block_id=$_GET[id]");

        $result = $db->query("SELECT * FROM room_subs rs LEFT JOIN rooms r ON rs.room_id=r.id WHERE block_id=$_GET[id]");
    }else{
        dd('stop');
    }
?>

</html>