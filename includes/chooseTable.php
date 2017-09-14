<?php 

session_start();

//echo implode(",",$tables_available_array);


?>
<!-- Modal -->
<div id="chooseTableModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div id="landscape" class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h3 class="modal-title title-red">Choose a Table</h3>
        </div>
        <div class="modal-body">
            <div class="row">
              <div class="col-md-12 col-xs-12"  id="restaurant">
                <div class="row pad3">
                  <div class="col-md-2 col-md-offset-3 col-xs-2 col-xs-offset-3">
                      <a class="<?php echo $tableN01Status; ?>" href="#" class="" id="table1"><img class="seats2" src="/images/1.svg"></img></a>
                  </div>
                  <div class="col-md-2 col-xs-2">
                      <a class="<?php echo $tableN02Status; ?>" href="#" class="" id="table2"><img class="seats2" src="/images/2.svg"></img></a>
                  </div>
                  <div class="col-md-2 col-xs-2">
                     <a class="<?php echo $tableN03Status; ?>" href="#" class="" id="table3"> <img class="seats2" src="/images/3.svg"></img></a>
                  </div>
                  <div class="col-md-2 col-xs-2">
                      <a class="<?php echo $tableN04Status; ?>" href="#" class="" id="table4"><img class="seats2" src="/images/4.svg"></img></a>
                  </div>
                </div>
                <div class="row pad3">
                  <div class="col-md-2 col-md-offset-3 col-xs-2 col-xs-offset-3">
                      <a class="<?php echo $tableN05Status; ?>" id="table5"href="#"><img class="seats4" src="/images/5.svg"></img></a>
                  </div>
                  <div class="col-md-2 col-xs-2">
                      <a class="<?php echo $tableN06Status; ?>" href="#" class="" id="table6"><img class="seats4" src="/images/6.svg"></img></a>
                  </div>
                  <div class="col-md-2 col-xs-2">
                     <a class="<?php echo $tableN07Status; ?>" href="#" class="" id="table7"> <img class="seats4" src="/images/7.svg"></img></a>
                  </div>
                </div>
                <div class="row pad3" style="margin-bottom: 5%">
                  <div class="col-md-3 col-md-offset-3 col-xs-3 col-xs-offset-3">
                     <a class="<?php echo $tableN08Status; ?>" href="#" class="" id="table8"> <img class="seats6" src="/images/8.svg"></img></a>
                  </div>
                  <div class="col-md-3 col-xs-3">
                     <a class="<?php echo $tableN09Status; ?>" href="#" class="" id="table9"> <img class="seats6" src="/images/9.svg"></img></a>
                  </div>
                  <div class="col-md-2 col-xs-2">
                      <a class="<?php echo $tableN10Status; ?>" href="#" class="" id="table10"><img class="seats4" src="/images/10.svg"></img></a>
                  </div>
                </div>
              </div>
            </div>
        </div>
    </div>
  </div>
</div>