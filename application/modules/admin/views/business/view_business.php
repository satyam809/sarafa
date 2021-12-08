<div id="main-wrapper">
    <div class="page-wrapper">
        <?php echo validation_errors(); ?>
        <?php if ($this->session->flashdata('Invalid') != '') { ?>
            <div class="alert alert-success hide_msg">
                <p><?php echo $this->session->flashdata('Invalid'); ?></p>
            </div>
        <?php } ?>
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-5 align-self-center">
                    <h4 class="page-title">Business</h4>
                    <div class="d-flex align-items-center">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">All Business</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="col-7 align-self-center">
                    <div class="d-flex no-block justify-content-end align-items-center">
                        <a id="add_cate" href="<?php echo base_url(); ?>admin/business/add_business" class="btn btn-info btn-rounded m-t-10 mb-2 float-right"><i class="mr-2 mdi mdi-plus"></i>Add New Business</a>
                        <!-- <a id="add_cate" href="<?php //echo base_url(); 
                                                    ?>admin/business/createXLSVendors" class="btn btn-primary btn-rounded m-t-10 mb-2 float-right"><i class="mr-2 mdi mdi-export"></i>Export Excel</a>
                        <a id="add_cate" href="<?php //echo base_url(); 
                                                ?>admin/business/pdf_viewer" class="btn btn-primary btn-rounded m-t-10 mb-2 float-right"><i class="mr-2 mdi mdi-export"></i>Export PDF</a> -->
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="price-summery">
                            <div class="card-body table-responsive">
                                <table id="user_list" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th colspan="5">
                                                Show:<select name="dp_entries">
                                                    <option value="10" selected="">10</option>
                                                    <option value="25">25</option>
                                                    <option value="50">50</option>
                                                    <option value="100">100</option>
                                                </select>entries
                                            </th>
                                            <th colspan="4">
                                                <label>Search :
                                                    <input type="search" name="search" id="search" class="form-control">
                                                </label>
                                            </th>
                                        </tr>
                                        <tr style="background-color: rgba(0,0,0,0.04)">
                                            <th><span class="icon">
                                                    <input type="checkbox" onclick="checkAll('chkgrow')" id="checkAll" name="chkall_agt" />
                                                </span></th>
                                            <!-- <th><a href="javascript:void(0);" field="int_glcode" class="_sort">Id</a></th> -->
                                            <th><a href="javascript:void(0);" field="fname" class="_sort">Name</a></th>
                                            <th><a href="javascript:void(0);" field="var_email" class="_sort">Email</a></th>

                                            <th><a href="javascript:void(0);" field="var_mobileno" class="_sort">Mobile No</a></th>
                                            <th><a href="javascript:void(0);" field="var_city" class="_sort">City</a></th>
                                            <th><a href="javascript:void(0);" field="var_state" class="_sort">State</a></th>
                                            <th><a href="javascript:void(0);" field="var_state" class="_sort">Category</a></th>
                                            <th>Publish</th>
                                        </tr>
                                    </thead>
                                    <input type="hidden" name="module" id="module" value="business">
                                    <tbody>
                                        <?php
                                        if (count($data) > 0) {
                                            foreach ($data as $row) {
                                                $tickimg = ($row['chr_publish'] == 'Y') ? "tick.png" : "tick_cross.png";
                                                if ($row['chr_publish'] == 'Y') {
                                                    $title = "Hide me";
                                                    $update_val = 'N';
                                                } else {
                                                    $title = "Display me";
                                                    $update_val = 'Y';
                                                }



                                                /////////////////////// if blank user name //////////////////

                                        ?>
                                                <tr id="<?php echo $row["int_glcode"]; ?>">
                                                    <td><input type="checkbox" name="ids[]" class="checkboxes" value="<?php echo $row['int_glcode']; ?>"></td>
                                                    <!-- <td><?php //echo $row['int_glcode']; 
                                                                ?></td> -->
                                                    <td><a href="<?php echo base_url() . 'admin/business/editBusiness/' . base64_encode($row['int_glcode']); ?>"><i class=" fas fa-pencil-alt"> </i> <?php echo $row['fname'] . ' ' . $row['lname']; ?></a>
                                                    </td>
                                                    <td><?php echo $row['var_email']; ?></td>
                                                    <td><?php echo $row['var_mobile_no']; ?></td>
                                                    <td><?php echo $row['var_city']; ?></td>
                                                    <td><?php echo $row['var_state']; ?></td>
                                                    <td><?php echo $row['catAs']; ?></td>
                                                    <td class="center">
                                                        <a href="javascript:void(0);">
                                                            <img id="tick-<?php echo $row['int_glcode']; ?>" height="16" width="16" alt="<?php echo $title; ?>" title="<?php echo $title; ?>" src="<?php echo base_url() . 'public/assets/images/site_imges/' . $tickimg; ?>" style="vertical-align:middle;cursor:pointer;" onclick="UpdatePublish('user', 'mst_users', 'chr_publish', '<?php echo $update_val; ?>', '<?php echo $row['int_glcode']; ?>');">
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php }
                                        } else { ?>
                                            <tr>
                                                <th colspan="8">
                                                <td>No data are available.</td>
                                                </th>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                                <input type="hidden" name="hfield" value="int_glcode">
                                <input type="hidden" name="hsort" value="desc">
                                <input type="hidden" name="hpageno" value="0">
                                <?php
                                if (count($data) > 0) {
                                ?>
                                    <div class="page-limit">
                                        <div id="pagination" style="float: right">
                                            <?php echo $pagination; ?>
                                        </div>
                                        <label id="showing_"><?php echo 'Showing 1 to ' . count($data) . ' of ' . $total_data . ' entries'; ?></label>
                                    </div>
                                    <input type="hidden" name="module" id="module" value="vendor">
                                    <button type="submit" class="btn btn-danger btn_fnt" name="btn_delete" id="btn_delete"><i class="icon dripicons-trash color_change"></i>Delete</button>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            var siteurl = '<?php echo base_url(); ?>';
        </script>
        <script>
            $('select[name=dp_entries]').change(function() {
                var entries = $(this).val();
                var append = $("#search").val();
                var field = $('input[name=hfield]').val();
                var sort = $('input[name=hsort]').val();

                loadPagination(0, field, sort, entries);
                $('input[name=hpageno]').val('0');
            });

            var pagenumber = 0;

            $("#btn_search").click(function() {

                var append = $("#search").val();
                var field = $('input[name=hfield]').val();
                var sort = $('input[name=hsort]').val();
                var entries = $('select[name=dp_entries]').val();

                $.ajax({

                    url: siteurl + 'admin/business/loadData/' + pagenumber,
                    type: 'get',
                    data: {
                        append: append,
                        field: field,
                        sort: sort,
                        entries: entries
                    },
                    dataType: 'json',
                    success: function(response) {


                        $('#pagination').html(response.pagination);

                        createTable(response.result, response.row, response.total_rows, response.total_data);
                    }
                });
            });

            $('#search').on('keyup', function() {

                var entries = $('select[name=dp_entries]').val();
                var field = $('input[name=hfield]').val();
                var sort = $('input[name=hsort]').val();

                if ($(this).val() == '') {

                    loadPagination(0, field, sort, entries);
                    $('input[name=hpageno]').val('0');
                } else {

                    var append = $("#search").val();
                    var field = $('input[name=hfield]').val();
                    var sort = $('input[name=hsort]').val();
                    var entries = $('select[name=dp_entries]').val();

                    $.ajax({

                        url: siteurl + 'admin/business/loadData/' + pagenumber,
                        type: 'get',
                        data: {
                            append: append,
                            field: field,
                            sort: sort,
                            entries: entries
                        },
                        dataType: 'json',
                        success: function(response) {


                            $('#pagination').html(response.pagination);
                            createTable(response.result, response.row, response.total_rows, response.total_data);
                        }
                    });
                }

            });
            $('#pagination').on('click', 'a', function(e) {

                e.preventDefault();

                var pageno = $(this).attr('data-ci-pagination-page');
                $('input[name=hpageno]').val(pageno);
                var entries = $('select[name=dp_entries]').val();
                var field = $('input[name=hfield]').val();
                var sort = $('input[name=hsort]').val();

                loadPagination(pageno, field, sort, entries);

            });

            $('._sort').on("click", function() {

                var field = $(this).attr('field');
                $('input[name=hfield]').val(field);
                var sort = $('input[name=hsort]').val();
                if (sort == 'desc') {
                    sort = 'asc';
                    $(this).closest('tr').find('i').remove();
                    $(this).closest('th').append('<i class="fa fa-long-arrow-up" style="font-size:15px"></i>');

                } else {
                    sort = 'desc';
                    $(this).closest('tr').find('i').remove();
                    $(this).closest('th').append('<i class="fa fa-long-arrow-down" style="font-size:15px"></i>');
                }

                $('input[name=hsort]').val(sort);
                var entries = $('select[name=dp_entries]').val();

                //var pagno = $('input[name=hpageno]').val();

                loadPagination(0, field, sort, entries);
            });

            //loadPagination(0,'int_glcode','desc');

            function loadPagination(pagno, field = 'int_glcode', sort = 'desc', entries = '10') {

                var append = $("#search").val();

                $.ajax({

                    url: siteurl + 'admin/business/loadData/' + pagno,

                    type: 'get',

                    data: {
                        append: append,
                        field: field,
                        sort: sort,
                        entries: entries
                    },

                    dataType: 'json',

                    success: function(response) {

                        $('#pagination').html(response.pagination);

                        createTable(response.result, response.row, response.total_rows, response.total_data);
                    }
                });
            }

            function createTable(result, sno, total_rows, total_data) {
                //alert(JSON.stringify(result));
                //console.log(JSON.stringify(result));return false;
                var sno = Number(sno);

                var start = sno + 1;

                if (result != null && result != '') {
                    var count_rows = result.length;
                }

                var end = sno + count_rows;

                $('#user_list tbody').empty();

                if (result == null || result == '') {

                    var tr = '<tr><td colspan="8">No results</td></tr>';

                    $('#user_list tbody').append(tr);

                    $('#showing_').text('');

                    return false;

                }

                for (index in result) {

                    var id = result[index].int_glcode;

                    var fname = result[index].fname;
                    var lname = result[index].lname;
                    var var_email = result[index].var_email;
                    var var_mobile = result[index].var_mobile_no;
                    var var_city = result[index].var_city;
                    var var_state = result[index].var_state;
                    var catAs = result[index].catAs;
                    // var var_image = result[index].var_image;

                    // if (var_image != '') {
                    //     var image = siteurl + 'uploads/business/' + var_image;
                    // } else {
                    //     var image = siteurl + 'public/assets/images/site_imges/no_image.png';
                    // }


                    var publish = result[index].chr_publish;

                    sno += 1;

                    var tr = "<tr id='" + id + "'>";

                    tr += "<td class='center'><input type='checkbox' name='ids[]' class='checkboxes' value=" + id + "></td>";
                    tr += "<td>" + id + "</td>";
                    tr += "<td><a href=" + siteurl + "admin/business/editBusiness/" + window.btoa(id) + "><i class=' fas fa-pencil-alt'></i> " + fname + " " + lname + "</a></td>";
                    tr += "<td>" + var_email + "</td>";
                    tr += "<td>" + var_mobile + "</td>";
                    tr += "<td>" + var_city + "</td>";
                    tr += "<td>" + var_state + "</td>";
                    tr += "<td>" + catAs + "</td>";
                    // tr += '<td><a class="example-image-link" href=' + image +
                    //     ' data-lightbox="example-set" data-title="Click anywhere outside the image or the X to the right to close."><img class="example-image" src=' + image +
                    //     ' id="cate_ig" alt=' + fname + " " + lname + ' /></a></td>';
                    if (publish == 'Y') {

                        var user = "'user'";
                        var mst_module = "'mst_users'";
                        var chr_publish = "'chr_publish'";
                        var N = "'N'";

                        tr += '<td><a href="javascript:void(0);"><img id="tick-' + id +
                            '" height="16" width="16" alt="" title="" src="' + siteurl +
                            'public/assets/images/site_imges/tick.png" style="vertical-align:middle;cursor:pointer;" onclick="UpdatePublish(' + user + ',' + mst_module + ',' + chr_publish + ',' + N + ',' + id + ');"></a></td>';
                    } else {

                        var user = "'user'";
                        var mst_module = "'mst_users'";
                        var chr_publish = "'chr_publish'";
                        var Y = "'Y'";

                        tr += '<td><a href="javascript:void(0);"><img id="tick-' + id +
                            '" height="16" width="16" alt="" title="" src="' + siteurl +
                            'public/assets/images/site_imges/tick_cross.png" style="vertical-align:middle;cursor:pointer;" onclick="UpdatePublish(' + user + ',' + mst_module + ',' + chr_publish + ',' + Y + ',' + id + ');"></a></td>';
                    }

                    tr += "</tr>";
                    //var first_id = $('table tr:first').attr('id');
                    //var last_id = $('table tr:last').attr('id');
                    //console.log(last_id);
                    $('#user_list tbody').append(tr);

                    var search = $('#search').val();

                    if (search == '') {
                        $('#showing_').text('Showing ' + start + ' to ' + end + ' of ' + total_rows + ' entries');
                    } else {
                        $('#showing_').text('Showing ' + start + ' to ' + end + ' of ' + total_rows + ' entries (filtered from ' + total_data + ' total entries)');

                    }
                }
            }
        </script>