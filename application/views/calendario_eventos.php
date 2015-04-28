<!doctype html>
<html>
<head>
<meta charset="utf-8">

<link href="<?php echo base_url() ?>css/estilosPrincipal.css" type="text/css" rel="stylesheet">
<script src="<?php echo base_url() ?>bower_components/jquery/jquery.min.js"></script>
<script src="<?php echo base_url() ?>bower_components/moment/moment.js"></script>
<script src="<?php echo base_url() ?>bower_components/eonasdan-bootstrap-datetimepicker/bootstrap/bootstrap.min.js"></script>
<script src="<?php echo base_url() ?>bower_components/eonasdan-bootstrap-datetimepicker/src/js/bootstrap-datetimepicker.js"></script>
<link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo base_url() ?>bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css" />
<script src="<?php echo base_url() ?>bower_components/eonasdan-bootstrap-datetimepicker/src/js/locales/bootstrap-datetimepicker.es.js"></script>

</head>

<body>
<section class='cuerpo'>

<div class="container">
    <div class="row">
    <h1 class="text-center heading">Añadir un nuevo evento</h1><hr>
    <?php echo form_open(base_url('mainController/guardaEvento')) ?>
        <div class="col-sm-8 col-sm-offset-2" style="height:75px;">
           <div class='col-md-6'>
                <div class="form-group">
                	<label for="body" class="col-sm-12 control-label">Fecha de hoy</label>
                    <div class='input-group date' id='from'>
                        <input type='date' name="from" class="form-control" />
                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="body" class="col-sm-12 control-label">Qué hemos hecho hoy</label>
                <div class="col-sm-12">
                  <textarea id="body" name="event" class="form-control" rows="10"></textarea>
                </div>
            </div>

             <input style="margin-top: 10px" type="submit" class="pull-right btn btn-success" value="Guardar evento">
 
        </div>
    <?php echo form_close() ?>
    </div>
    <script type="text/javascript">
        $(function () {
            $('#from').datetimepicker({
                language: 'es',
                minDate: new Date()
            });
        });
    </script>
</div>

</section>
</body>