<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dependent Dropdown / Country > State >City/title</title>
    <link href="<?php echo base_url('public/css/bootstrap.min.css') ;?>" rel="stylesheet">
</head>

<body>
    <div class="container pt-2">
        <div class="row ">
            <div class="col-md-12">
                <h3 class="bg-dark text-white p-3">Dependent Dropdown / Country > State > City</h3>
            </div>
            <div class="col-md-12">
                <?php
                if(!empty($this->session->userdata('success'))) {
                    ?>
                    <div class="alert alert-success"><?php echo $this->session->userdata('success'); ?></div>
                    <?php
                }
                ?>

                <?php
                if(!empty($this->session->userdata('error'))) {
                    ?>
                    <div class="alert alert-danger"><?php echo $this->session->userdata('error'); ?></div>
                    <?php
                }
                ?>
                <div class="row">
                    <div class="col-md-11">
                        <h3>View Users</h3>
                    </div>
                    <div class="col-md-1">
                        <a href="<?php echo base_url('home/create');?>" class="btn btn-primary">Create</a>
                    </div>
                </div>
                <hr>
                <table class="table table-striped">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                    <tbody>
                        <?php if(!empty($users)){
                            foreach ($users as $user) {
                        ?>
                        <tr>
                            <td><?php echo $user['id'];?></td>
                            <td><?php echo $user['name'];?></td>
                            <td><?php echo $user['email'];?></td>
                            <td>
                                <a href="<?php echo base_url('home/edit/'.$user['id']);?>" class="btn btn-primary">Edit</a>      
                            </td>
                        </tr>
                        <?php }
                        } 
                        ?>
                    </tbody>

                </table>
            </div>
        </div>
    </div>
</body>