<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dependent Dropdown / Country > State > City</title>
    <link href="<?php echo base_url('public/css/bootstrap.min.css') ;?>" rel="stylesheet">
</head>

<body>
    <div class="container pt-2">
        <div class="row ">
            <div class="col-md-12">
                <h3 class="bg-dark text-white p-3">Dependent Dropdown / Country > State > City</h3>
            </div>

            <form action="" method="post" name="createFrm" id="createFrm">
                <div class="col-md-12">
                    <h3>Create User</h3>
                    <hr>

                    <div class="form-group ">
                        <label for="" class="pb-2">Name</label>
                        <input type="text" name="name" id="name" class="form-control pb-1" placeholder="Please enter name">
                            <p class="name_error" ></p>
                    </div>

                    <div class="form-group">
                        <label for="" class=" pt-3 pb-2">Email</label>
                        <input type="text" name="email" id="email" class="form-control" placeholder="Please enter email">
                            <p class="email_error" ></p>
                    </div>

                    <div class="form-group">
                        <label for="country" class="pt-3 pb-2 ">Country</label><br>
                        <select name="country" id="country" class="form-control">
                            <option value="">Select a Country</option>
                            <?php 
                        if(!empty($countries)){
                            foreach ($countries as $country) {
                               ?>
                            <option value="<?php echo $country['id'];?>"><?php echo $country['name'];?></option>
                            <?php
                            }
                        }
                        ?>
                        </select>
                        <p class="country_error" ></p>
                    </div>

                    <div class="form-group">
                        <label for="state" class="pt-3 pb-2 ">State</label><br>
                        <div id="statesBox">
                            <select name="state" id="state" class="form-control">
                                <option value="">Select a State</option>
                            </select>
                            <p class="state_error" ></p>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="city" class="pt-3 pb-2 ">City</label><br>
                        <div id="citiesBox">
                            <select name="city" id="city" class="form-control pb-1">
                                <option value="">Select a City</option>
                            </select>
                            <p class="city_error" ></p>
                        </div>
                    </div>

                    <div class="form-group pt-3 pb-2">
                        <button class="btn btn-primary " type="submit">Create</button>

                        <a href="<?php echo base_url('home/index'); ?>" class="btn btn-secondary">BACK</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

</body>

<script src="<?php echo base_url('public/js/code.jquery.com_jquery-3.7.1.min.js');?>"></script>

<script>
$(document).ready(function() {
    $("#country").change(function() {
        // Here we will run an ajax request
        var country_id = $(this).val(); // Selected country id
        //alert(country_id);

        var baseUrl = '<?php echo base_url('home/getStates'); ?>';

        $.ajax({
            url: baseUrl,
            type: 'POST',
            data: {country_id: country_id},
            dataType: 'json',
            success: function(response) {
                if (response['states']) {
                    $("#statesBox").html(response['states']);
                }
            }
        });
        //When in country and state there is nothing to select then in city also reset, for that use below code use
            $("#citiesBox").html("<select name=\"city\" id=\"city\" class=\"form-control pb-1\">\
                                        <option value=\"\">Select a City</option>\
                                  </select>");
        

    });

    // by using below code we can check that ajax is running or not
    $(document).on("change", "#state", function() {
        // Here we will run an ajax request
        var state_id = $(this).val(); // Selected state id
        //alert(state_id); // check ajax is running or not

        var baseUrl = '<?php echo base_url('home/getCities'); ?>';

        $.ajax({
            url: baseUrl,
            type: 'POST',
            data: {state_id: state_id},
            dataType: 'json',
            success: function(response) {
                if (response['cities']) {
                    $("#citiesBox").html(response['cities']);
                }
            }
        });
    });
});

$("#createFrm").submit(function(event) {
    event.preventDefault();

    $.ajax({
        url:'<?php echo base_url('home/saveUser'); ?>',
        type: 'post',
        data: $(this).serializeArray(), //$(this).serializeArray() --- This will show all detail eksath, one by one leke jane ki jrurat nahi padegi
        dataType: 'json',
        success: function(response) {
            if(response['status'] == 0) {
                if(response['name']) {
                    $(".name_error").html(response['name']);
                }else{
                    $(".name_error").html("");
                }

                if(response['email']) {
                    $(".email_error").html(response['email']);
                }else{
                    $(".email_error").html("");
                }

                if(response['country']) {
                    $(".country_error").html(response['country']);
                }else{
                    $(".country_error").html("");
                }

                if(response['state']) {
                    $(".state_error").html(response['state']);
                }else{
                    $(".state_error").html("");
                }

                if(response['city']) {
                    $(".city_error").html(response['city']);
                }else{
                    $(".city_error").html("");
                }
            } else {
                window.location.href= "<?php echo base_url('home/index') ?>";
            }
            //console.log(response)
        }
    });

});
</script>


</html>