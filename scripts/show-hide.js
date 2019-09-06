$(document).ready(function(){
    //show regular search option and its show button
    $("#hide_reg_button").show(); //since reg search option viewable
    $("#show_reg_button").hide();

    $("#hide_post_button").hide();
    $("#hide_upload_button").hide();

    $('#reg_search_option').show();
    $('#post_search_option').hide();
    $('#upload_option').hide();


    //show/hide for regular search
    $("#show_reg_button").click(function(){
        $('#reg_search_option').show();
        $('#show_reg_button').hide();
        $("#hide_reg_button").show();
    });
    $("#hide_reg_button").click(function(){
        $('#reg_search_option').hide();
        $('#show_reg_button').show();
        $("#hide_reg_button").hide();
    });

    //show/hide for post search
    $("#show_post_button").click(function(){
        $('#post_search_option').show();
        $('#show_post_button').hide();
        $("#hide_post_button").show();
    });
    $("#hide_post_button").click(function(){
        $('#post_search_option').hide();
        $('#show_post_button').show();
        $("#hide_post_button").hide();
    });

    //show/hide for upload
    $("#show_upload_button").click(function(){
        $('#upload_option').show();
        $('#show_upload_button').hide();
        $("#hide_upload_button").show();
    });
    $("#hide_upload_button").click(function(){
        $('#upload_option').hide();
        $('#show_upload_button').show();
        $("#hide_upload_button").hide();
    });

  });
