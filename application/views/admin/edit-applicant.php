<div>
    <form method="post" action="" id="edit_applicant_form" class="" enctype="multipart/form-data">
        <div class="row">
            <input type="hidden" name="applicant_id" value="<?php echo $applicant->id; ?>" />
            <div class="col-sm-12">
                <div class="form-group" style="margin-top:10px;">
                    <label class="col-sm-2 control-label no-padding-right" for="applicant_name"> Applicant's Name
                    </label>
                    <div class="col-sm-4">
                        <input type="text" id="applicant_name" name="applicant_name" class="form-control"
                            value="<?php echo !empty( $applicant ) && isset($applicant->applicant_name) ? $applicant->applicant_name : ''; ?>" />
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group" style="margin-top:10px;">
                    <label class="col-sm-2 control-label no-padding-right" for="applicant_email"> Email Address
                    </label>
                    <div class="col-sm-4">
                        <input type="text" id="applicant_email" class="form-control" name="applicant_email" value="<?php echo !empty( $applicant ) && isset($applicant->applicant_email) ? $applicant->applicant_email : ''; ?>" />
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group" style="margin-top:10px;">
                    <label class="col-sm-2 control-label no-padding-right" for="applicant_name"> Malling Address
                    </label>
                    <div class="col-sm-10">
                        <div class="row">

                            <div class="form-group col-md-4">
                                <label for="applicant_division">Division</label>
                                <select id="applicant_division" name="applicant_division" class="form-control">
                                    <option value="">Select Division..</option>
                                    <?php 
                                        if( !empty( $divisions ) ){
                                            foreach( $divisions as $divsion ){ ?>
                                                <option <?php echo ($applicant->applicant_division == $divsion->id) ? 'selected' : ''; ?> value="<?php echo $divsion->id;?>"> <?php echo $divsion->division_en; ?>
                                    </option>
                                    <?php }
                                        }
                                    ?>

                                </select>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="applicant_district">District</label>
                                <select id="applicant_district" name="applicant_district" class="form-control">
                                    <option value="">Select District..</option>
                                    <?php 
                                        $districs = get_districs_by_division($applicant->applicant_division);
                                        if( !empty( $districs ) ){
                                            foreach( $districs as $dist ){ ?>
                                    <option <?php echo ($dist->id == $applicant->applicant_district) ? 'selected' : ''; ?> value="<?php echo $dist->id;?>"> <?php echo $dist->district_en; ?>
                                    </option>
                                    <?php }
                                        }
                                    ?>

                                </select>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="applicant_upazila">Upazila/Thana</label>
                                <select id="applicant_upazila" name="applicant_upazila" class="form-control">
                                    <option value="">Select Upazila..</option>
                                    <?php 
                                    $upazilas = get_upazilas_by_district($applicant->applicant_district);
                                        if( !empty( $upazilas ) ){
                                            foreach( $upazilas as $upa ){ ?>
                                    <option <?php echo ($upa->id == $applicant->applicant_upazila) ? 'selected' : ''; ?> value="<?php echo $upa->id;?>"> <?php echo $upa->upazila_en; ?>
                                    </option>
                                    <?php }
                                        }
                                    ?>

                                </select>
                            </div>

                        </div>
                    </div>
                </div>

            </div>

            <div class="col-sm-12">
                <div class="form-group" style="margin-top:10px;">
                    <label class="col-sm-2 control-label no-padding-right" for="applicant_name"> Address Details
                    </label>
                    <div class="col-sm-8">
                        <textarea id="address_details" name="address_details" class="form-control" rows="3"><?php echo $applicant->address_details;?></textarea>
                    </div>
                </div>
            </div>

            <div class="col-sm-12">
                <fieldset class="form-group">
                    <label class="col-form-label col-sm-2 pt-0">Language Proficiency</label>
                    <div class="col-sm-10">

                        <div class="form-check">
                            <input class="form-check-input col-sm-1" type="checkbox" name="language_proficiency_bangla"
                                value="bangla" id="bangla" <?php echo !empty($applicant->language_proficiency_bangla) ? 'checked' : '';?>>
                            <label class="form-check-label" for="bangla">
                                Bangla
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input col-sm-1" type="checkbox" name="language_proficiency_english"
                                value="english" id="english" <?php echo !empty($applicant->language_proficiency_english) ? 'checked' : '';?>>
                            <label class="form-check-label" for="english">
                                English
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input col-sm-1" type="checkbox" name="language_proficiency_french"
                                value="french" id="french" <?php echo !empty($applicant->language_proficiency_french) ? 'checked' : '';?>>
                            <label class="form-check-label" for="french">
                                French
                            </label>
                        </div>
                    </div>
                </fieldset>
            </div>

            <div class="form-group col-sm-12">
                <label for="" class="col-sm-2 col-form-label">Education Qualification</label>
                <div class="col-sm-10 educational-qualifacation-area">
                    <?php 
                        $applicant_educations = get_applicant_education_by_id($applicant->id);
                        if( !empty( $applicant_educations ) ){
                            foreach( $applicant_educations as $edu ) { ?>
                                <div class="row edu-qul-inner">
                                    <input type="hidden" name="exam_id[]" value="<?php echo $edu->id; ?>" />
                                    <div class="form-group col-md-3">
                                        <label for="applicant_exam_name_0">Exam Name</label>
                                        <select id="applicant_exam_name_0" name="applicant_exam_name[]"
                                            class="form-control applicant-exam-name">
                                            <option value="">Select Exam..</option>
                                            <?php 
                                            if( !empty( $examinations ) ){
                                                foreach( $examinations as $exm ) { ?>
                                            <option <?php echo $edu->exam_name == $exm->id ? 'selected' : ''; ?> value="<?php echo $exm->id; ?>"> <?php echo $exm->name; ?> </option>
                                            <?php }
                                            }
                                        ?>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="applicant_university_0">University</label>
                                        <select id="applicant_university_0" name="applicant_university[]"
                                            class="form-control applicant-university">
                                            <option value="">Select University..</option>
                                            <?php 
                                            if( !empty( $universities ) ){
                                                foreach( $universities as $university ) { ?>
                                            <option <?php echo $edu->university_name == $university->id ? 'selected' : ''; ?> value="<?php echo $university->id; ?>"> <?php echo $university->name; ?>
                                            </option>
                                            <?php }
                                            }
                                        ?>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="applicant_board_0">Board</label>
                                        <select id="applicant_board_0" name="applicant_board[]"
                                            class="form-control applicant-board">
                                            <option value="">Select Board..</option>
                                            <?php 
                                            if( !empty( $boards ) ){
                                                foreach( $boards as $board ) { ?>
                                            <option <?php echo $edu->board_name == $board->id ? 'selected' : ''; ?> value="<?php echo $board->id; ?>"> <?php echo $board->name; ?> </option>
                                            <?php }
                                            }
                                        ?>
                                        </select>
                                    </div>

                                    <div class="form-group col-sm-2">
                                        <label for="applicant_result_0">Result</label>
                                        <input type="text" class="form-control applicant-result" id="applicant_result_0"
                                            name="applicant_result[]" value="<?php echo $edu->result; ?>">
                                    </div>

                                    </div>
                           <?php }

                        }
                    ?>
                    

                </div>
            </div>

            <div class="form-group col-sm-12">
                <label for="applicant_photo" class="col-sm-2 col-form-label">Photo</label>
                <div class="col-sm-8">
                    <div class="custom-file mb-3">
                        <input type="file" class="form-control applicantPhoto" id="applicant_photo"
                            name="applicant_photo">
                            <input type="hidden" class="form-control" id="old_applicant_photo" name="old_applicant_photo" value="<?php echo $applicant->applicant_photo; ?>">
                    </div>
                </div>
            </div>
            <div class="form-group col-sm-12">
                <label for="applicant_photo" class="col-sm-2 col-form-label">CV Attachment</label>
                <div class="col-sm-8">
                    <div class="custom-file mb-3">
                        <input type="file" class="form-control" id="applicant_cv" name="applicant_cv">
                        <input type="hidden" class="form-control" id="old_applicant_cv" name="old_applicant_cv" value="<?php echo $applicant->applicant_cv; ?>">
                    </div>
                </div>
            </div>

            <div class="form-group col-sm-12">
                <label for="inputPassword3" class="col-sm-2 col-form-label">Training</label>
                <div class="col-sm-10">
                    <div class="form-check">
                        <input class="form-check-input col-sm-1 toggole-training" type="radio" name="is_training"
                            value="yes" id="training_yes" <?php echo ($applicant->is_training == 'yes') ? 'checked' : ''; ?>>
                        <label class="form-check-label" for="training_yes">
                            Yes
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input col-sm-1 toggole-training" type="radio" name="is_training"
                            value="no" id="training_no" <?php echo ($applicant->is_training == 'no') ? 'checked' : ''; ?>>
                        <label class="form-check-label" for="training_no">
                            No
                        </label>
                    </div>


                    <div class="training-details p-2" style="<?php echo ($applicant->is_training == 'yes') ? 'display:block' : 'display:none'; ?>;">
                        <?php 
                        $trainings = get_applicant_trainings_by_id($applicant->id);
                            if(!empty( $trainings )){
                                foreach( $trainings as $tra ) { ?>
                                    <div class="row training-details-inner">
                                    <input type="hidden" name="tra_id[]" value="<?php echo $tra->id; ?>" />
                                        <div class="form-group col-md-5">
                                            <label for="training_name_0">Training Name</label>
                                            <input type="text" class="form-control" id="training_name_0" name="training_name[]" value="<?php echo $tra->traning_name; ?>">
                                        </div>

                                        <div class="form-group col-md-5">
                                            <label for="training_details_0">Training Details</label>
                                            <input type="text" class="form-control" id="training_details_0"
                                                name="training_details[]" value="<?php echo $tra->traning_details; ?>">
                                        </div>

                                    </div>
                               <?php }
                            } 
                        ?>
                        

                    </div>

                </div>

            </div>


            <div class="col-sm-12" style="margin-top:30px;">
                <div class="form-group">
                    <div class="col-sm-12 text-right">
                        <button id="submit_btn" type="submit" name="update_applicant" value="update"
                            class="btn btn-primary btn-submit">Update</button>
                    </div>
                </div>
            </div>

        </div>

    </form>

</div>