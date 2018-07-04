@extends('layouts.app')
@section('header-css')
    <style type="text/css">
        .member-label{
          margin-left: 5%;
          margin-top: 10%;
          padding: 0px;
        }
        .notification-image {
            padding: 10px;
            width: 150px;
            height: 150px;
        }
    </style>
    <style type="text/css">
        .memberinfotop{
            margin-top: 100px;
        }
        .memberinfo{
            margin:10px;
        }
        .image{
            height:150px;
            width:150px;
        }
        .topcontent{
            padding-top:20px;
        }
        .content{
            padding-top: 20px;
            padding-left: 5px;
        }
        .button{
            float:right;
        }
        #map{
            width:180px;
            height:180px;
            background:yellow;
            margin:auto;
        }
        @media only screen and (max-width: 360px){
            body{
                font-size: 12px;
            }
        }
    </style>
@endsection
@section('content')
<div class="container top-margin">
    <div class="row" style="min-height: 722px !important;">
        <div class="col-md-10 col-md-offset-1">
            <div class="">
                <div class="row" >
                    <form class="form-horizontal">
                        <div class="form-group">
                            <div class="col-md-3">
                                <div class="topcontent">
                                    <select class="form-control" name="city" id="city" onClick="getContactByCity(this.value);">
                                        <option value="">Select City</option>
                                        <option value="All">All</option>
                                        <option value="1">Amravati City</option>
                                        <option value="0">Other City</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="topcontent">
                                    <input type="text" name="contact" id="contact" class="form-control"  placeholder="search contact" onfocus onkeyup="searchContact(this.value);" >
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                @if(count($contacts) > 0)
                <div class="row">
                    <div id="allContact" style="border: 2px solid grey;">
                        @foreach($contacts as $contact)
                        <div class="row memberinfo">
                            <p><strong>Name: </strong>{{($contact->name)?:'-'}}</p>
                            <p><strong>Phone: </strong>{{($contact->phone)?:'-'}}</p>
                            <p><strong>Description: </strong>{{($contact->description)?:'-'}}</p>
                        </div>
                        <hr>
                        @endforeach
                    </div>
                </div>
                @else
                    No notification
                @endif
            </div>
        </div>
    </div>
</div>
@include('layouts.footer')
<script type="text/javascript">
    $(document).ready(function() {
        $('#contact').focus();
    });

    function getContactByCity(city){
        var currentToken = $('meta[name="csrf-token"]').attr('content');
        if(city){
            $.ajax({
                method:'POST',
                url: "{{url('get-contact-by-city')}}",
                data:{_token:currentToken,city:city}
            }).done(function( contacts ) {
                var allContact = document.getElementById('allContact');
                allContact.innerHTML = '';
                if(contacts.length > 0){
                    $.each(contacts, function(idx,obj){
                        var firstDiv = document.createElement('div');
                        firstDiv.className = 'row memberinfo';
                        var firstDivInnerHTML = '';
                        if(obj.name){
                            var name = obj.name;
                        } else {
                            var name = '-';
                        }
                        firstDivInnerHTML = '<p><strong>Name: </strong>'+name+'</p>';
                        if(obj.phone){
                            var phone = obj.phone;
                        } else {
                            var phone = '-';
                        }
                        firstDivInnerHTML += '<p><strong>Phone: </strong>'+phone+'</p>';

                        if(obj.description){
                            var description = obj.description;
                        } else {
                            var description = '-';
                        }
                        firstDivInnerHTML += '<p><strong>Description: </strong>'+description+'</p>';
                        firstDiv.innerHTML = firstDivInnerHTML;
                        allContact.appendChild(firstDiv);
                        var hrEle = document.createElement('hr');
                        allContact.appendChild(hrEle);
                    })
                } else {
                    allContact.innerHTML = 'No Result';
                }
                $('#contact').focus();
            });
        } else if( 0 == city.length) {
            window.location.reload();
        }
    }

    function searchContact(contact){
        var currentToken = $('meta[name="csrf-token"]').attr('content');
        var city = document.getElementById('city').value;
        if(contact.length > 2){
            $.ajax({
                method:'POST',
                url: "{{url('search-contact')}}",
                data:{_token:currentToken,contact:contact,city:city}
            }).done(function( contacts ) {
                var allContact = document.getElementById('allContact');
                allContact.innerHTML = '';
                if(contacts.length > 0){
                    $.each(contacts, function(idx,obj){
                        var firstDiv = document.createElement('div');
                        firstDiv.className = 'row memberinfo';
                        var firstDivInnerHTML = '';
                        if(obj.name){
                            var name = obj.name;
                        } else {
                            var name = '-';
                        }
                        firstDivInnerHTML = '<p><strong>Name: </strong>'+name+'</p>';
                        if(obj.phone){
                            var phone = obj.phone;
                        } else {
                            var phone = '-';
                        }
                        firstDivInnerHTML += '<p><strong>Phone: </strong>'+phone+'</p>';

                        if(obj.description){
                            var description = obj.description;
                        } else {
                            var description = '-';
                        }
                        firstDivInnerHTML += '<p><strong>Description: </strong>'+description+'</p>';
                        firstDiv.innerHTML = firstDivInnerHTML;
                        allContact.appendChild(firstDiv);
                        var hrEle = document.createElement('hr');
                        allContact.appendChild(hrEle);
                    })
                } else {
                    allContact.innerHTML = 'No Result';
                }
                $('#contact').focus();
            });
        } else if( 0 == contact.length) {
            window.location.reload();
        }
    }
</script>


@endsection