function downloadf(file) {
    alert(file);

    $.get("/document/download/" + file, function(data, status) {


    });

}

function showupload(val, q) {
    if (val.length > 0) {
        $('#doc' + q).show();
        $('#addfile' + q).show();
    } else {
        $('#doc' + q).hide();
        $('#addfile' + q).hide();
    }
}

function autocomp(text) {
    var url = '<?php echo base_url();?>' + 'document/getAutoCompletedocument/' + $('#docid').val();
    $("#linkeddoc" + $('#counter').val()).autocomplete({
        source: url,
        messages: {
            noResults: '',
            results: function() {}
        },
        select: function(event, ui) {
            var selectedObj = ui.item;
            var customer = selectedObj.value.replace("amp;", "");
            //$("#contractorselected").val(1);
            $('#linkeddoc' + $('#counter').val()).val(ui.item.document_name);
            $('#linkeddocid' + $('#counter').val()).val(ui.item.id);
        }
    });
}


function showapprovedby(val) {
    //alert(val);
    if (val == 1) {
        $('.approveddiv').show();
    } else {
        $('.approveddiv').hide();
    }
    showbtn();
}

function addpassword() {
    $('#passwordprotection').toggle();
}

function addext(val) {
    $('#exten').show();
    $('#exten').val(val);
    showbtn();
}

var counter = 2;

function addFile() {
    $('.deleteRow').show();

    $('#row' + counter).show();
    counter++;
}

var counter2 = 2;

function addFile2() {
    var document_id = $('#linkeddocid' + $('#counter').val()).val();
    var link_to = $('#docid').val();

    if (document_id != "") {
        $.post('save_document_link', {
            document_id: document_id,
            link_to: link_to
        }, function(result) {
            //alert(result);
        })
    } else {

    }


    $('#counter').val(counter2);
    $('#rows' + counter2).show();
    counter2++;
}

function splitsentence(val) {
    var words = val.split(" ");
    $(words).each(function(index, text) {
        $.get("/document/getTag/" + text, function(data, status) {

            $.each(data, function(id, name) {
                var name = name;
                var docid = $('#docid').val();
                if ($("#" + name).length == 0) {
                    $("<span id=" + name + ">" + name + "</span>").appendTo("#tags");
                    $.post('addmoretags', {
                        name: name,
                        docid: docid
                    }, function(result) {

                    })
                } else {}

            });

        });
    });
    showbtn();
}
$(function() { // DOM ready
    addFile2();

});

function savephoto(instance, id) {
    $('#incomp').show();
    $('#process').hide();
    $('#savebutton').hide();
    var docid = $('#docid').val();
    var origfilename = $("#" + instance).prop('files')[0]['name'];
    var parts = origfilename.split('.');
    var ext = parts[parts.length - 1];
    if (ext.length > 0 && ext != 'doc') {
        $('#loader').show();
        $('#' + instance + 'uploaded').html('');
        $('#loader' + id).show();

    }

    var description = $('#desc' + id).val();
    filename = instance + "-" + docid + "." + ext;
    instancename = 'file_' + instance;
    var file_data = $("#" + instance).prop("files")[0]; // Getting the properties of file from file field
    var form_data = new FormData(); // Creating object of FormData class
    form_data.append("file", file_data); // Appending parameter named file with properties of file_field to form_data
    form_data.append("newname", filename); // Adding extra parameters to form_data
    form_data.append("docid", docid);
    form_data.append("type", instance);
    form_data.append("instancename", instancename);
    form_data.append("description", description);
    form_data.append("originalfilename", parts[parts.length - 2]);

    $('#desc' + id).show();
    $('#desc' + id).val(parts[parts.length - 2]);

    if (ext.length > 0 && ext != 'doc') {
        $('#addfile' + id).hide();
        addFile();
    }

    $.ajax({
        url: "<?php echo base_url(); ?>document/savehrimage", // Upload Script
        dataType: 'script',
        cache: false,
        contentType: false,
        processData: false,
        data: form_data, // Setting the data attribute of ajax with file_data
        type: 'post',
        success: function(data) {
            $('#uploaded' + instance).html('');

            if (data === 0) {
                $('#savebutton').show();
                alert('File ' + instance + ' could not be uploaded successfully, please try again.');
                $('#photo' + instance + 'sys').html(filename + ' uploaded failed');
                $('#photo' + instance + 'sys').show();
            } else {
                $('#doc' + id).hide();

                $('#incomp').show();
                $('#process').hide();
                $('#savebutton').show();
                if (ext === 'jg') {
                    setTimeout(
                        function() {
                            if (ext.length > 0) {
                                $('#loader').hide();
                                $('#loader' + id).hide();

                                $('#incomp').hide();
                                $('#process').show();

                                addFile();
                            }

                            $('#' + instance + 'uploaded').html("<img style='max-height:15px;' src='<?php echo base_url(); ?>application/docs/" + filename + "'>");
                        }, 2500);


                } else if (ext == 'pdf') {
                    $.get("/document/getfiledetails", function(data2, status) {
                        $.get("/document/getfiledetails2", function(data3, status) {
                            setTimeout(
                                function() {
                                    $('#loader').hide();
                                    $('#loader' + id).hide();

                                    $('#incomp').hide();
                                    $('#process').show();
                                    $('#' + instance + 'uploaded').html("<a target='_blank' href='<?php echo base_url(); ?>application/docs/" + data2.trim() + "'><img style='max-height:40px;' src='<?php echo base_url(); ?>application/images/png/pdf.png'></a><a href='#' onclick='delf(" + data3.trim() + ")'>Delete</a>");
                                }, 2500);
                            $('#filecryp' + id).val(data2.trim());

                        });
                    });
                } else if (ext == 'docx') {


                    $.get("/document/getfiledetails", function(data2, status) {
                        $.get("/document/getfiledetails2", function(data3, status) {
                            setTimeout(
                                function() {
                                    $('#loader').hide();
                                    $('#loader' + id).hide();

                                    $('#incomp').hide();
                                    $('#process').show();

                                    $('#' + instance + 'uploaded').html("<a target='_blank' href='<?php echo base_url(); ?>application/docs/" + data2.trim() + "'><img style='max-height:40px;' src='<?php echo base_url(); ?>application/images/png/doc.png'></a><a href='#' onclick='delf(" + data3.trim() + ")'>Delete</a>");
                                }, 2500);
                            $('#filecryp' + id).val(data2.trim());
                        });
                    });



                } else if (ext == 'doc') {
                    //alert('.doc format not allowed, try docx instead');
                    $('#' + instance + 'uploaded').html('.doc format not allowed, try docx instead');

                } else if (ext == 'csv') {


                    $.get("/document/getfiledetails", function(data2, status) {
                        $.get("/document/getfiledetails2", function(data3, status) {
                            setTimeout(
                                function() {
                                    $('#loader').hide();
                                    $('#loader' + id).hide();

                                    $('#incomp').hide();
                                    $('#process').show();
                                    $('#' + instance + 'uploaded').html("<a download href='<?php echo base_url(); ?>application/docs/" + data2.trim() + "'><img style='max-height:40px;' src='<?php echo base_url(); ?>application/images/png/csv.png'></a></a><a href='#' onclick='delf(" + data3.trim() + ")'>Delete</a>");
                                }, 2500);
                            $('#filecryp' + id).val(data2.trim());
                        });
                    });



                } else if (ext == 'xls' || ext == 'xlsx') {


                    $.get("/document/getfiledetails", function(data2, status) {
                        $.get("/document/getfiledetails2", function(data3, status) {
                            setTimeout(
                                function() {
                                    $('#loader').hide();
                                    $('#loader' + id).hide();

                                    $('#incomp').hide();
                                    $('#process').show();
                                    $('#' + instance + 'uploaded').html("<a target='_blank' href='<?php echo base_url(); ?>application/docs/" + data2.trim() + "'><img style='max-height:40px;' src='<?php echo base_url(); ?>application/images/png/xls.png'></a></a><a href='#' onclick='delf(" + data3.trim() + ")'>Delete</a>");
                                }, 2500);
                            $('#filecryp' + id).val(data2.trim());
                        });
                    });



                } else if (ext == 'ppt') {


                    $.get("/document/getfiledetails", function(data2, status) {
                        $.get("/document/getfiledetails2", function(data3, status) {
                            setTimeout(
                                function() {
                                    $('#loader').hide();
                                    $('#loader' + id).hide();

                                    $('#incomp').hide();
                                    $('#process').show();
                                    $('#' + instance + 'uploaded').html("<a target='_blank' href='<?php echo base_url(); ?>application/docs/" + data2.trim() + "'><img style='max-height:40px;' src='<?php echo base_url(); ?>application/images/png/ppt.png'></a><a href='#' onclick='delf(" + data3.trim() + ")'>Delete</a>");
                                }, 2500);
                            $('#filecryp' + id).val(data2.trim());
                        });
                    });



                } else if (ext == 'rtf') {


                    $.get("/document/getfiledetails", function(data2, status) {
                        $.get("/document/getfiledetails2", function(data3, status) {
                            setTimeout(
                                function() {
                                    $('#loader').hide();
                                    $('#loader' + id).hide();

                                    $('#incomp').hide();
                                    $('#process').show();
                                    $('#' + instance + 'uploaded').html("<a target='_blank' href='<?php echo base_url(); ?>application/docs/" + data2.trim() + "'><img style='max-height:40px;' src='<?php echo base_url(); ?>application/images/png/rtf.png'></a><a href='#' onclick='delf(" + data3.trim() + ")'>Delete</a>");
                                }, 2500);
                            $('#filecryp' + id).val(data2.trim());
                        });
                    });



                } else if (ext == 'jpg') {


                    $.get("/document/getfiledetails", function(data2, status) {
                        $.get("/document/getfiledetails2", function(data3, status) {
                            setTimeout(
                                function() {
                                    $('#loader').hide();
                                    $('#loader' + id).hide();

                                    $('#incomp').hide();
                                    $('#process').show();
                                    $('#' + instance + 'uploaded').html("<a target='_blank' href='<?php echo base_url(); ?>application/docs/" + data2.trim() + "'><img style='max-height:40px;' src='<?php echo base_url(); ?>application/images/png/jpg.png'></a><a href='#' onclick='delf(" + data3.trim() + ")'>Delete</a>");
                                }, 2500);
                            $('#filecryp' + id).val(data2.trim());
                        });
                    });



                } else if (ext == 'png') {


                    $.get("/document/getfiledetails", function(data2, status) {
                        $.get("/document/getfiledetails2", function(data3, status) {
                            setTimeout(
                                function() {
                                    $('#loader').hide();
                                    $('#loader' + id).hide();

                                    $('#incomp').hide();
                                    $('#process').show();
                                    $('#' + instance + 'uploaded').html("<a target='_blank' href='<?php echo base_url(); ?>application/docs/" + data2.trim() + "'><img style='max-height:40px;' src='<?php echo base_url(); ?>application/images/png/png.png'></a><a href='#' onclick='delf(" + data3.trim() + ")'>Delete</a>");
                                }, 2500);
                            $('#filecryp' + id).val(data2.trim());
                        });
                    });



                } else if (ext == 'zip') {


                    $.get("/document/getfiledetails", function(data2, status) {
                        $.get("/document/getfiledetails2", function(data3, status) {
                            setTimeout(
                                function() {
                                    $('#loader').hide();
                                    $('#loader' + id).hide();

                                    $('#incomp').hide();
                                    $('#process').show();
                                    $('#' + instance + 'uploaded').html("<a target='_blank' href='<?php echo base_url(); ?>application/docs/" + data2.trim() + "'><img style='max-height:40px;' src='<?php echo base_url(); ?>application/images/png/zip.png'></a><a href='#' onclick='delf(" + data3.trim() + ")'>Delete</a>");
                                }, 2500);
                            $('#filecryp' + id).val(data2.trim());
                        });
                    });



                } else if (ext == 'txt') {


                    $.get("/document/getfiledetails", function(data2, status) {
                        $.get("/document/getfiledetails2", function(data3, status) {
                            setTimeout(
                                function() {
                                    $('#loader').hide();
                                    $('#loader' + id).hide();

                                    $('#incomp').hide();
                                    $('#process').show();
                                    $('#' + instance + 'uploaded').html("<a target='_blank' href='<?php echo base_url(); ?>application/docs/" + data2.trim() + "'><img style='max-height:40px;' src='<?php echo base_url(); ?>application/images/png/txt.png'></a><a href='#' onclick='delf(" + data3.trim() + ")'>Delete</a>");
                                }, 2500);
                            $('#filecryp' + id).val(data2.trim());
                        });
                    });



                } else if (ext == 'tiff') {


                    $.get("/document/getfiledetails", function(data2, status) {
                        $.get("/document/getfiledetails2", function(data3, status) {
                            setTimeout(
                                function() {
                                    $('#loader').hide();
                                    $('#loader' + id).hide();

                                    $('#incomp').hide();
                                    $('#process').show();
                                    $('#' + instance + 'uploaded').html("<a target='_blank' href='<?php echo base_url(); ?>application/docs/" + data2.trim() + "'><img style='max-height:40px;' src='<?php echo base_url(); ?>application/images/png/tiff.png'></a><a href='#' onclick='delf(" + data3.trim() + ")'>Delete</a>");
                                }, 2500);
                            $('#filecryp' + id).val(data2.trim());
                        });
                    });



                } else if (ext == 'pptx') {


                    $.get("/document/getfiledetails", function(data2, status) {
                        $.get("/document/getfiledetails2", function(data3, status) {
                            setTimeout(
                                function() {
                                    $('#loader').hide();
                                    $('#loader' + id).hide();

                                    $('#incomp').hide();
                                    $('#process').show();
                                    $('#' + instance + 'uploaded').html("<a target='_blank' href='<?php echo base_url(); ?>application/docs/" + data2.trim() + "'><img style='max-height:40px;' src='<?php echo base_url(); ?>application/images/png/pptx.png'></a><a href='#' onclick='delf(" + data3.trim() + ")'>Delete</a>");
                                }, 2500);
                            $('#filecryp' + id).val(data2.trim());
                        });
                    });



                } else if (ext == 'xlsm') {


                    $.get("/document/getfiledetails", function(data2, status) {
                        $.get("/document/getfiledetails2", function(data3, status) {
                            setTimeout(
                                function() {
                                    $('#loader').hide();
                                    $('#loader' + id).hide();

                                    $('#incomp').hide();
                                    $('#process').show();
                                    $('#' + instance + 'uploaded').html("<a target='_blank' href='<?php echo base_url(); ?>application/docs/" + data2.trim() + "'><img style='max-height:40px;' src='<?php echo base_url(); ?>application/images/png/xlsm.png'></a><a href='#' onclick='delf(" + data3.trim() + ")'>Delete</a>");
                                }, 2500);
                            $('#filecryp' + id).val(data2.trim());
                        });
                    });


                } else if (ext == 'docx') {


                    $.get("/document/getfiledetails", function(data2, status) {
                        $.get("/document/getfiledetails2", function(data3, status) {
                            setTimeout(
                                function() {
                                    $('#loader').hide();
                                    $('#loader' + id).hide();

                                    $('#incomp').hide();
                                    $('#process').show();
                                    $('#' + instance + 'uploaded').html("<a target='_blank' href='<?php echo base_url(); ?>application/docs/" + data2.trim() + "'><img style='max-height:40px;' src='<?php echo base_url(); ?>application/images/png/doc.png'><a href='#' onclick='delf(" + data3.trim() + ")'>Delete</a></a>");
                                }, 2500);
                            $('#filecryp' + id).val(data2.trim());
                        });
                    });



                } else {
                    $('#' + instance + 'uploaded').html(origfilename);

                }
            }

        }
    });
}

function delf(id) {
    $.get("/document/delf/" + id, function(data2, status) {
        $("#delnewf").delegate("td:nth-child(3) a", "click", function() {
            $(this).closest("tr").hide();
        });

    });
}

function uploadselect(selid, id) {

    $('#' + selid).trigger('click');
    addFile();
}

function appendCon(val) {
    $('#contractingparty').val(val);
}

function clearblur() {
    $('#blurdiv').hide();

    $('#contractor_div').hide();
    $('#category_div').hide();
    $('#subcategory_div').hide();
}

function newcomment(val) {

    $('#blurdiv').show();
    if (val == 'category') {
        $('#category_div').show();
    } else if (val == 'subcategory') {
        $('#subcategory_div').show();
    } else if (val == 'contractor') {
        $('#contractor_div').show();
    }

}

function appendCat() {
    $('#catname').empty();
    $.get("/document/getcats/", function(data, status) {
        //alert('n');
        var opt = $('<option />');
        opt.val(0);
        opt.text('--Please Select--');
        $('#catname').append(opt);
        $.each(data, function(id, name) {
            // here we're creating a new select option for each group
            var opt = $('<option />');
            opt.val(id);
            opt.text(name);
            $('#catname').append(opt);
        });
    });
}

function savecomment(val) {

    $('#category_div').hide();
    $('#subcategory_div').hide();
    $('#contractor_div').hide();
    $('#blurdiv').hide();

    //Dynamic category save
    var newcategory = $('#newcategory').val();
    var catdescription = $('#catdescription').val();

    //Dynamic subcategory save
    var catname = $('#catname').val();
    var newsubcategory = $('#newsubcategory').val();
    var subcatdescription = $('#subcatdescription').val();
    var hascontract = ($('#hascontract').is(":checked") ? 1 : 0);

    //Dynamic contractor save
    var categoryname = $('#newcontractor').val();

    if (val == 'category') {
        $.post('addnewcategorydynamic', {
            newcategory: newcategory,
            catdescription: catdescription,
            hascontract: hascontract
        }, function(result) {

            //Rebuild Category select
            $('#categoryname').empty();


            setTimeout(
                function() {
                    $.get("/document/getcats/", function(data, status) {
                        var opt = $('<option />');
                        opt.val(0);
                        opt.text('--Please Select--');
                        $('#categoryname').append(opt);
                        $.each(data, function(id, name) {
                            // here we're creating a new select option for each group
                            var opt = $('<option />');
                            opt.val(id);
                            opt.text(name);
                            $('#categoryname').append(opt);
                            //$('#catname').append(opt); 
                        });
                        $('select[name="categoryname"]').find('option[value=' + result + ']').attr("selected", true);

                        showbtn2();
                    });
                }, 1500);

            appendCat();
        });

    } else if (val == 'subcategory') {
        var subcatsel = '';
        $.post('addnewsubcategorydynamic', {
            catname: catname,
            newsubcategory: newsubcategory,
            subcatdescription: subcatdescription
        }, function(result) {
            //Rebuild Subcategory select
            $('#subcategoryname').empty();
            var te = $('#categoryname').val();
            setTimeout(
                function() {
                    $.get("/document/getsubcatsdynamic/" + te, function(data, status) {
                        var opt = $('<option />');
                        opt.val(0);
                        opt.text('--Please Select--');
                        $('#subcategoryname').append(opt);
                        $.each(data, function(id, name) {
                            // here we're creating a new select option for each group
                            var opt = $('<option />');
                            opt.val(id);
                            opt.text(name);
                            $('#subcategoryname').append(opt);
                        });
                        $('select[name="subcategoryname"]').find('option[value=' + result + ']').attr("selected", true);
                        showbtn();
                    });
                }, 1500);


        });

    } else if (val == 'contractor') {

        var newcontractorname = $('#newcontractorname').val();
        var contractperson = $('#contractperson').val();
        var address = $('#address').val();
        var tel = $('#tel').val();
        var email = $('#email').val();

        $('#contractingparty').val(newcontractorname);

        $.post('addnewcontractordynamic', {
            contractorname: newcontractorname,
            contractperson: contractperson,
            address: address,
            tel: tel,
            email: email
        }, function(result) {
            $('#contractingpartyid').val(result);

        });

    }

}

function showbtn2(cat, catval) {

    $("#catname option[value=" + cat + "]").prop('selected', true);

    $.get("/document/hasCon/" + cat, function(data, status) {
        if (data == 0) {
            $('#contractingparty').val('Not Applicable');
            $('#contractingparty').attr('readonly', true);
            $('#hascon').hide();
            $.get("/document/conid/Not Applicable", function(data2, status) {
                $('#contractingpartyid').val(data2.trim());
            });

        } else {
            $('#hascon').show();
            $('#contractingpartyid').val('');
            $('#contractingparty').val('');
            $('#contractingparty').attr('readonly', false);
        }

    });

    $('#documentname').val($("#categoryname option:selected").text() + '-');

    $('#subcategoryname').empty();
    $.get("/document/getsubcats/" + cat, function(data, status) {
        var opt = $('<option />');
        opt.val(0);
        opt.text('--Please Select--');
        $('#subcategoryname').append(opt);
        $.each(data, function(id, name) {
            var opt = $('<option />'); // here we're creating a new select option for each group
            opt.val(id);
            opt.text(name);
            $('#subcategoryname').append(opt);
        });
    });

    validate();
    if ($('#documentname').val() != '' && $('#description').val() != '' && $('#categoryname').val() != '' && $('#subcategoryname').val() != '' && $('#contractingparty').val() != '' && $('#departmentname').val() != '' && $('#groupname').val() != '' && $('#startdate').val() != '' && $('#enddate').val() != '' && $('#reviewdate').val() != '' && $('#renewaldate').val() != '') {
        $('#incomp').hide();
        $('#process').show();
    } else {
        $('#incomp').show();
        $('#process').hide();
    }

    $('#editname').show();

    var contents = $('#documentname').val();
    var charlength = contents.length;
    newwidth = charlength * 8.5;
    $('#documentname').css({
        width: newwidth
    });
    //splitsentence(cat)
}

function view() {

    $('#add').hide();
    $('#divview').hide();
    $('#view').show();
    $('#divadd').show();

}

function showbtn4() {
    $('#contractingpartyid').val('');
    showbtn();
}


function showbtn3(seg, catval) {
    var selval = '';
    $('#documentname').val($("#categoryname option:selected").text() + '-');
    //$("#documentname").append($("#categoryname option:selected").text()+'-');

    $('#departmentname').empty();

    if ($("#segmentname option:selected").text() == 'All') {
        //alert('Thabiso');
        $.get("/document/getAlldepartments/", function(data, status) {
            var opt = $('<option />');
            $('#departmentname').append(opt);
            $.each(data, function(id, name) {
                if (name == 'All') {
                    selval = id;
                } else {

                }
                var opt = $('<option />'); // here we're creating a new select option for each group
                opt.val(id);
                opt.text(name);
                $('#departmentname').append(opt);
            });
            var $el = $("select[name=departmentname]").find('option[value=' + selval + ']');
            $("select[name=departmentname]").find('option[value=' + selval + ']').remove();
            $("select[name=departmentname]").find('option:eq(0)').before($el);

            $('select option')
                .filter(function() {
                    return !this.value || $.trim(this.value).length == 0 || $.trim(this.text).length == 0;
                })
                .remove();
        });
    } else {
        $.get("/document/getdeparts/" + seg, function(data, status) {
            var opt = $('<option />');
            $('#departmentname').append(opt);
            $.each(data, function(id, name) {
                if (name == 'All') {
                    selval = id;
                } else {

                }
                var opt = $('<option />'); // here we're creating a new select option for each group
                opt.val(id);
                opt.text(name);
                $('#departmentname').append(opt);
            });

            sortDroplist('departmentname');
            var $el = $("select[name=departmentname]").find('option[value=' + selval + ']');
            $("select[name=departmentname]").find('option[value=' + selval + ']').remove();
            $("select[name=departmentname]").find('option:eq(0)').before($el);

            $('select option')
                .filter(function() {
                    return !this.value || $.trim(this.value).length == 0 || $.trim(this.text).length == 0;
                })
                .remove();
        });
    }



    validate();
    if ($('#documentname').val() != '' && $('#description').val() != '' && $('#categoryname').val() != '' && $('#subcategoryname').val() != '' && $('#contractingparty').val() != '' && $('#departmentname').val() != '' && $('#groupname').val() != '' && $('#startdate').val() != '' && $('#enddate').val() != '' && $('#reviewdate').val() != '' && $('#renewaldate').val() != '') {
        $('#incomp').hide();
        $('#process').show();
    } else {
        $('#incomp').show();
        $('#process').hide();
    }

    $('#editname').show();

    var contents = $('#documentname').val();
    var charlength = contents.length;
    newwidth = charlength * 8.5;
    $('#documentname').css({
        width: newwidth
    });
    //splitsentence(cat)
}

function sortDroplist(selectId) {
    var foption = $('#' + selectId + ' option:first');
    var soptions = $('#' + selectId + ' option:not(:first)').sort(function(a, b) {
        return a.text == b.text ? 0 : a.text < b.text ? -1 : 1
    });
    $('#' + selectId).html(soptions).prepend(foption);

};

function iscontract() {

    if ($('#contractingparty').is('[readonly]')) {

        if ($('#documentname').val() != '' && $('#description').val() != '' && $('#categoryname').val() != '' && $('#subcategoryname').val() != '' && $('#contractingparty').val() != '' && $('#departmentname').val() != '' && $('#groupname').val() != '' && $('#reviewdate').val() != '') {
            $('#incomp').hide();
            $('#process').show();
        } else {
            $('#incomp').show();
            $('#process').hide();
        }

    } else {

        if ($('#documentname').val() != '' && $('#description').val() != '' && $('#categoryname').val() != '' && $('#subcategoryname').val() != '' && $('#contractingparty').val() != '' && $('#departmentname').val() != '' && $('#groupname').val() != '' && $('#startdate').val() != '' && $('#enddate').val() != '' && $('#reviewdate').val() != '' && $('#renewaldate').val() != '') {
            $('#incomp').hide();
            $('#process').show();
        } else {
            $('#incomp').show();
            $('#process').hide();
        }

    }

}

function view() {
    $('#add').hide();
    $('#divview').hide();
    $('#view').show();
    $('#divadd').show();
}

function add() {

    $('#view').hide();
    $('#divadd').hide();
    $('#add').show();
    $('#divview').show();
}



var countdownstart = 3;

function countdown() {

    $('#successful').show();

    var check = function() {

        if (countdownstart === 0) {
            $('#countdown').html(0);
            document.location.href = "/document/types";

        } else {

            $('#timer').show();
            $('#timer2').show();
            $('#countdown').html(countdownstart);
            countdownstart = countdownstart - 1;
            setTimeout(check, 1000);

        }
    }

    setTimeout(check, 1000);
}

function updatedescription(id, description) {
    var id = $('#filecryp' + id).val();
    var description = description;

    var url = '<?php echo base_url();?>' + 'document/updatedescription2';
    $.post(url, {
        id: id,
        description: description
    }, function(result) {

    })

}

function process() {


    $('#process').hide();
    $('#processing').fadeIn('fast');

    var documentname = $('#documentname').val() + ' ' + $('#exten').val();
    var description = $('#description').val();
    var categoryname = $('#categoryname').val();
    var subcategoryname = $('#subcategoryname').val();
    var contractingpartyid = $('#contractingpartyid').val();
    var departmentname = $('#departmentname').val();
    var groupname = $('#groupname').val();
    var startdate = $('#startdate').val();
    var enddate = $('#enddate').val();
    var reviewdate = $('#reviewdate').val();
    var renewaldate = $('#renewaldate').val();
    var additionalownerid = $('#additionalownerid').val();
    var docowerid = $('#docowerid').val();
    //var approved = $('#approved').val();
    //var approvedbyid=$('#approvedbyid').val();
    //var approvedate=$('#approvedate').val();
    var docid = $('#docid').val();
    var segmentname = $('#segmentname').val();
    var workplacename = $('#workplacename').val();
    var passwordprotection = $('#passwordprotection').val();

    $.post('save_new_document', {
        documentname: documentname,
        description: description,
        categoryname: categoryname,
        subcategoryname: subcategoryname,
        contractingpartyid: contractingpartyid,
        departmentname: departmentname,
        groupname: groupname,
        startdate: startdate,
        enddate: enddate,
        reviewdate: reviewdate,
        renewaldate: renewaldate,
        additionalownerid: additionalownerid,
        docid: docid,
        passwordprotection: passwordprotection,
        workplacename: workplacename,
        docowerid: docowerid,
        segmentname: segmentname
    }, function(result) {
        //alert(result);////d//
        if (result != 1) {
            $('#processing').fadeOut('fast');
            $('#failed').fadeIn('fast');


        } else {
            var newtab = "/document/print_document/dn/" + docid;
            var win = window.open(newtab, '_blank');
            win.focus();

            $('#processing').hide();
            $('#successful').show();
            document.location.href = "/document/newdocument";
        }

    })
}

$(document).ready(function() {
    //
    if ($('#hcperm').val() == 0) {
        $('#hcp').hide();
    }

    if ($('#hscperm').val() == 0) {
        $('#hscp').hide();
    }

    if ($('#hcoperm').val() == 0) {
        $('#hascon').hide();
    }

    var $el = $("select[name=departmentname]").find('option[value="30"]');
    $("select[name=departmentname]").find('option[value="30"]').remove();
    $("select[name=departmentname]").find('option:eq(1)').before($el);

    var $el = $("select[name=segmentname]").find('option[value="6"]');
    $("select[name=segmentname]").find('option[value="6"]').remove();
    $("select[name=segmentname]").find('option:eq(1)').before($el);

    addFile();
    $("#contractingparty").autocomplete({
        source: "getAutoCompleteContractor",
        messages: {
            noResults: '',
            results: function() {}
        },
        select: function(event, ui) {
            var selectedObj = ui.item;
            var customer = selectedObj.value.replace("amp;", "");
            $("#contractorselected").val(1);
            $('#contractingparty').val(ui.item.contract_name);
            $('#contractingpartyid').val(ui.item.id);
        }
    });


    $("#newcontractorname").autocomplete({
        source: 'getAutoCompleteContractor',
        messages: {
            noResults: function() {
                $('#savecontract').show();
            },
            results: function() {
                $('#savecontract').hide();
            }
        },
        select: function(event, ui) {
            alert('contract already exists');

            var selectedObj = ui.item;
            var customer = selectedObj.value.replace("amp;", "");
            $('#newcontractorname').val(ui.item.contract_name);
        }
    });

    $("#additionalowner").autocomplete({
        source: "getAutoCompletehrpeople",
        messages: {
            noResults: '',
            results: function() {}
        },
        select: function(event, ui) {
            var selectedObj = ui.item;
            var customer = selectedObj.value.replace("amp;", "");
            $("#contractorselected").val(1);
            $('#additionalowner').val(ui.item.hr_name);
            $('#additionalownerid').val(ui.item.id);
        }
    });

    $("#approvedby").autocomplete({
        source: "getAutoCompletehrpeople",
        messages: {
            noResults: '',
            results: function() {}
        },
        select: function(event, ui) {
            var selectedObj = ui.item;
            var customer = selectedObj.value.replace("amp;", "");
            $("#contractorselected").val(1);
            $('#approvedby').val(ui.item.hr_name);
            $('#approvedbyid').val(ui.item.id);
        }
    });



    $('#catdescription').autocomplete({
        source: function(request, response) {
            $.ajax({
                url: "getAutoCompleteCategory",
                dataType: "json",
                data: {
                    term: request.term,
                    catdescription: $('#catdescription').val()
                },
                success: function(data) {
                    response(data);
                    if (data.length != '') {
                        $('#savecategory').hide();
                    } else {
                        $('#savecategory').show();
                    }
                },
            });
        },
        minLength: 2

            ,
        select: function(event, ui) {
            alert('Category already exists');
            $('#savecategory').hide();
            var selectedObj = ui.item;
            var customer = selectedObj.value.replace("amp;", "");
            $('#newcategory').val(ui.item.contract_name);

        },

    });


    $('#subcatdescription').autocomplete({
        source: function(request, response) {
            $.ajax({
                url: "getAutoCompleteSubCategory",
                dataType: "json",
                data: {
                    term: request.term,
                    catdescription: $('#subcatdescription').val(),
                    catname: $('#catname').val()
                },
                success: function(data) {
                    response(data);
                    if (data.length != '') {
                        $('#savesubcategory').hide();
                    } else {
                        $('#savesubcategory').show();
                    }
                },
            });
        },
        minLength: 2

            ,
        select: function(event, ui) {
            alert('Subcategory already exists');
            $('#savecategory').hide();
            var selectedObj = ui.item;
            var customer = selectedObj.value.replace("amp;", "");
            $('#newcategory').val(ui.item.contract_name);

        },

    });

    $('.datepicker').datetimepicker({
        timepicker: false,
        format: 'Y-m-d',
    });

    $('#documentname').keydown(function() {
        var contents = $('#documentname').val();
        var charlength = contents.length;
        newwidth = charlength * 8.5;
        $('#documentname').css({
            width: newwidth
        });
    });

    $.get("/document/outstanding_documentation/", function(data, status) {});

});