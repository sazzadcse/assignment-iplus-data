<div class="row">

<?php 
    $view_success_msg = '';
    if ($this->session->flashdata('success_msg') != '')
        $view_success_msg = $this->session->flashdata('success_msg');
    if (isset($success_msg))
        $view_success_msg .= $success_msg;
    if (!empty($view_success_msg)) {
        ?>
        <div class="alert alert-success">
            <?php echo $view_success_msg; ?>
        </div>
    <?php } ?> 

    <form method="get" action="">
        <div class="col-xs-12 col-md-12 col-lg-12" style="margin-bottom:15px;">

            <div class="form-group" style="margin-top:10px;">
                <label class="col-sm-2 control-label no-padding-right" for="applicant_name"> Applicant's Name </label>
                <div class="col-sm-4">
                    <input type="text" id="applicant_name" name="applicant_name" class="form-control"
                        value="<?php echo $this->input->get('applicant_name'); ?>" />
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label no-padding-right" for="applicant_email"> Email Address </label>
                <div class="col-sm-4">
                    <input type="text" id="applicant_email" name="applicant_email" class="form-control"
                        value="<?php echo $this->input->get('applicant_email'); ?>" />
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-1 control-label no-padding-right" for="applicant_division"> Division </label>
                <div class="col-sm-2">
                    <select id="applicant_division" name="applicant_division" class="form-control">
                        <option value="">Select Division..</option>
                        <?php 
                            if( !empty( $divisions ) ){
                                foreach( $divisions as $divsion ){ ?>
                        <option
                            <?php echo ($this->input->get('applicant_division') == $divsion->id) ? 'selected' : ''; ?>
                            value="<?php echo $divsion->id;?>"> <?php echo $divsion->division_en; ?> </option>
                        <?php }
                            }
                        ?>

                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-1 control-label no-padding-right" for="applicant_district"> District </label>
                <div class="col-sm-2">
                    <select id="applicant_district" name="applicant_district" class="form-control">
                        <option>Select District..</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-1 control-label no-padding-right" for="applicant_upazila"> Upazila </label>
                <div class="col-sm-2">
                    <select id="applicant_upazila" name="applicant_upazila" class="form-control">
                        <option>Select Upazila/Thana..</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-1">
                    <input type="submit" class="btn btn-primary btn-small" value="search">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-1">
                    <a href="<?php echo base_url('admin/dashboard'); ?>" class="btn btn-danger btn-small">Cancel</a>
                </div>
            </div>

        </div>
    </form>
</div>

<div class="table-header">
    Applicant list
</div>
<div>
    <table id="dynamic-table" class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th>Applicant&#39;s Name</th>
                <th>Email Address</th>
                <th>Division</th>
                <th>District</th>
                <th>Upazila /Thana</th>
                <th>Insert Date</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>

            <?php 
                if( !empty( $applicants ) ){
                    foreach( $applicants as $row ){
            ?>

            <tr>
                <td><?php echo $row->applicant_name; ?></td>
                <td><?php echo $row->applicant_email; ?></td>
                <td><?php echo $row->division_en; ?></td>
                <td><?php echo $row->district_en; ?></td>
                <td><?php echo $row->upazila_en; ?></td>
                <td>
                    <?php 
                        echo date('d M, y', strtotime( $row->created_at ) );
                    ?>
                </td>

                <td>
                    <div class="hidden-sm hidden-xs action-buttons">

                        <a class="green" href="<?php echo base_url('edit_applicant/'. $row->applicant_id); ?>" title="Edit">
                            <i class="ace-icon fa fa-pencil bigger-130"></i>
                        </a>
                    </div>


                </td>
            </tr>

            <?php 
                } 
            } else { ?>
            <tr>
                <td colspan="7" class="center"> No data found!! </td>
            </tr>
            <?php }
            ?>

        </tbody>
    </table>

    <div class="tablenav top">
        <div class="float-right tablenav-pages">
            <span class="displaying-num"><?php isset($item_count) ? $item_count : 0; ?> items</span>
            <nav aria-label="Page navigation example">
                <?php echo $this->pagination->create_links(); ?>
            </nav>
        </div>
        <div class="clearfix"></div>
    </div>

</div>