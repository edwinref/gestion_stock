

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Ajouter un Member
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Member</li>
      </ol>
    </section>
<section class="content">

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-default">
        <div class="box-header with-border">
    

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
        <div class="col-md-12 col-xs-12">
          
          <?php if($this->session->flashdata('success')): ?>
            <div class="alert alert-success alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <?php echo $this->session->flashdata('success'); ?>
            </div>
          <?php elseif($this->session->flashdata('error')): ?>
            <div class="alert alert-error alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <?php echo $this->session->flashdata('error'); ?>
            </div>
          <?php endif; ?>

         
            <form role="form" action="<?php base_url('Controller_Members/create') ?>" method="post">
              <div class="box-body">

                <?php echo validation_errors(); ?>
                <div class="row">
                <div class="col-md-6">
                <div class="form-group">
                  <label for="groups">Autorisation</label>
                  <select class="form-control" id="groups" name="groups">
                    <option value="">Sélectionnez l'autorisation</option>
                    <?php foreach ($group_data as $k => $v): ?>
                      <option value="<?php echo $v['id'] ?>"><?php echo $v['group_name'] ?></option>
                    <?php endforeach ?>
                  </select>
                </div>
                </div>
               <div class="col-md-6">
                <div class="form-group">
                  <label for="fname">Prénom</label>
                  <input type="text" class="form-control" id="fname" name="fname" placeholder="Prénom" autocomplete="off">
                </div>
                </div>

                <div class="col-md-6">
                <div class="form-group">
                  <label for="username">Nom d'utilisateur</label>
                  <input type="text" class="form-control" id="username" name="username" placeholder="Nom d'utilisateur" autocomplete="off">
                </div>
                </div>
                
               
                 <div class="col-md-6">
                <div class="form-group">
                  <label for="lname">Nom</label>
                  <input type="text" class="form-control" id="lname" name="lname" placeholder="Nom" autocomplete="off">
                </div>
                </div>






              
                  
                  <div class="col-md-6">
                <div class="form-group">
                  <label for="password">Mot de passe</label>
                  <input type="password" class="form-control" id="password" name="password" placeholder="Password" autocomplete="off">
                </div>
                </div>

                 <div class="col-md-6">

                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" class="form-control" id="email" name="email" placeholder="Email" autocomplete="off">
                </div>
                </div>
                <div class="col-md-6">
                <div class="form-group">
                  <label for="cpassword">Confirmez le mot de passe</label>
                  <input type="password" class="form-control" id="cpassword" name="cpassword" placeholder="Confirm Password" autocomplete="off">
                </div>
                </div>
                
                
              
                <div class="col-md-6">

                <div class="form-group">
                  <label for="phone">Téléphone</label>
                  <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone" autocomplete="off">
                </div>
                </div>
                </div>

                <div class="form-group">
                  <label for="gender">Sexe</label>
                  <div class="radio">
                    <label>
                      <input type="radio" name="gender" id="male" value="1">
                      Male
                    </label>
                    <label>
                      <input type="radio" name="gender" id="female" value="2">
                      Femelle
                    </label>
                  </div>
                </div>

              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Sauvegarder  Fermer</button>
                <a href="<?php echo base_url('Controller_Members/') ?>" class="btn btn-warning">Back</a>
              </div>
            </form>
          </div>
          <!-- /.box -->
        </div>
        <!-- col-md-12 -->
      </div>
          <!-- /.row -->
        </div>
        <!-- /.box-body -->
       
      </div>
      <!-- /.box -->

 

    </section>