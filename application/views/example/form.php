<?php $this->load->view('template/main') ?>
<?php $this->load->view('vendor/datatable') ?>
<link rel="stylesheet" href="<?php echo site_url('assets/vendor/semantic/components/label.css') ?>"/>
<div class="row">
    <div class="col-md-3">
        <div class="card">
            <div class="header">
                <a class="ui teal ribbon label" style="font-size: 15px;">Overviewawdawd awdawd awd</a>
            </div>
            <div class="content">
                <p>Larger, yet dramatically thinner. More powerful, but remarkably power efficient. With a smooth metal surface that seamlessly meets the new Retina HD display.</p>
                <p>The first thing you notice when you hold the phone is how great it feels in your hand. There are no distinct edges. No gaps. Just a smooth, seamless bond of metal and glass that feels like one continuous surface.</p>
                <p><a class="ui tag label">New</a><a class="ui red tag label">Upcoming</a></p>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="card">
            <div class="header">
                <h4 class="title">Form</h4>
                <hr class="hr"/>
            </div>    
            
            <div class="content">
                <form class="form-horizontal">
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-10">
                      <input type="email" class="form-control" id="inputEmail3" placeholder="Email">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
                    <div class="col-sm-10">
                      <select class="form-control">
                        <option value="1">1</option>
                        <option value="2">2</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
                    <div class="col-sm-10">
                      <input type="password" class="form-control input-lg" id="inputPassword3" placeholder="Password">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <div class="checkbox">
                        <label>
                          <input type="checkbox"> Remember me
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-default">Sign in</button>
                    </div>
                  </div>
                </form>
            </div>
        </div>
        <div class="card">
            <div class="header">
                <h4 class="title">Pagination</h4>
                <hr class="hr"/>
            </div>    
            <div class="content">
                <table class="table table-bordered table-hover" id="toggleColumn-datatable">
                    <thead class="thead">
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Position</th>
                            <th>Office</th>
                            <th>Age</th>
                            <th>Start date</th>
                            <th>Salary</th>
                        </tr>
                    </thead>
                    <tbody style="border: none;">
                        <?php for($i=1; $i<=35; $i++){ ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td>Tiger Nixon</td>
                            <td>System Architect</td>
                            <td>Edinburgh</td>
                            <td>61</td>
                            <td>2011/04/25</td>
                            <td>$320,800</td>
                        </tr>
                        <?php }?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card">
            <div class="header">
                <h4 class="title">Pagination</h4>
                <hr class="hr"/>
            </div>    
            <div class="content">
                <ul class="pagination"> 
                    <!--   
                        color-classes: "pagination-blue", "pagination-azure", "pagination-orange", "pagination-red", "pagination-green"       
                    -->
                    <li><a href="#"><span class="glyphicon glyphicon-chevron-left"></span></a></li>
                    <li><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li class="active"><a href="#">3</a></li>
                    <li><a href="#">4</a></li>
                    <li><a href="#">5</a></li>
                    <li><a href="#"><span class="glyphicon glyphicon-chevron-right"></span></a></li>
                </ul>
                
                <ul class="pagination pagination-no-border"> 
                    <li><a href="#"><span class="glyphicon glyphicon-chevron-left"></span></a></li>
                    <li><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li class="active"><a href="#">3</a></li>
                    <li><a href="#">4</a></li>
                    <li><a href="#">5</a></li>
                    <li><a href="#"><span class="glyphicon glyphicon-chevron-right"></span></a></li>
                </ul>
                    
            </div>
        </div>
    </div>
</div>
<script>
$(function(){
    $('#toggleColumn-datatable').dataTable();
});
</script>
<?php $this->load->view('template/footer') ?>