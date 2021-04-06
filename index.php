<?php
    include_once('classes/city.php');
    include_once('classes/postcode.php');
    include_once('classes/street.php');
    include_once('classes/connection.php');

    $connection=new Connection();
    $db=$connection->connect();

    $city=new City($db);
    $res=$city->get();
    $countCitites=$res->rowCount();
    if($countCitites>0){
        $cities=$res->fetchAll();
    }

    $street=new Street($db);
    $res=$street->get();
    $count=$res->rowCount();
    if($count>0){
        $streets=$res->fetchAll();
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Postcodes Management</title>
        <link rel="stylesheet" href="design.css">
    </head>

    <body>
        <div id="cities">
            <h2>Adauga Oras</h2>
            <form id="city_form" action="">
                <div class="input">
                    <label for="city_name">Nume Oras</label>
                    <input type="text" name="name" id="city_name" class="input_txt">
                </div>
                <button type="submit" name="submit" id="city_add" class="button">Adauga</button>
            </form>
        </div>

        <div id="streets">
            <h2>Adauga Strada</h2>

            <form id="street_form" action="">
                <div class="input">
                    <label for="street_name">Nume Strada</label>
                    <input type="text" name="name" id="street_name" class="input_txt">
                </div>

                <div class="input">
                    <label for="street_city">Oras</label>
                    <select name="street_city" id="street_city">
                        <?php for($i=0;$i<count($cities);$i++){ ?> 
                            <option value="<?php echo $cities[$i]['id']; ?>"><?php echo $cities[$i]['name']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <button type="submit" id="street_add" class="button">Adauga</button>
            </form>
        </div>

        <div id="postcodes">
            <h2>Adauga Cod Postal</h2>
            <form id="postcode_form" action="">
                <div class="input">
                    <label for="postcode_name">Cod Postal</label>
                    <input type="text" name="name" id="postcode_name" class="input_txt">
                </div>

                <div class="input">
                    <label for="city_postcode">Oras</label>
                    <select name="city_postcode" id="city_postcode">
                        <?php for($i=0;$i<count($cities);$i++){ ?> 
                            <option value="<?php echo $cities[$i]['id']; ?>"><?php echo $cities[$i]['name']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="input">
                    <label for="street_postcode">Strada</label>
                    <select name="street_postcode" id="street_postcode">
                        <?php 
                        for($i=0;$i<count($streets);$i++){ ?> 
                            <option value="<?php echo $streets[$i]['id']; ?>"><?php echo $streets[$i]['name']; ?></option>
                        <?php } ?> 
                    </select>      
                </div>
                <button type="submit" id="postcode_add" class="button">Adauga</button>
            </form>
        </div>
        <script  type="module" src="functions.js"></script>
    </body>
</html>