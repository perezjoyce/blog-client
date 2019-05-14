$(document).ready(function(){
    // BTNS
    $('#deleteBlogTrigger').on('click', function(e){
        e.preventDefault;
        e.stopPropagation;

        const blogId = $(this).data('id');
        const blogTitle = $(this).data('title');
        $('#deleteBlogId').val(blogId);
        $('#deleteBlogTitle').val(blogTitle);
      })

    $('.saveEditsBtn').on('click', function(){
      const postBody = tinymce.activeEditor.getContent();
      $('#postBody').val(postBody);
      
      $('#save-form').submit();
      $('.modal').modal('close');
    })

    $('.cancelEditsBtn').on('click', function(){
      $('.modal').modal('close');
    })

    $('#submitHandler').on('click', function() {

      // alert($('#isFeatured').val());
      const postBody = tinymce.activeEditor.getContent();
      $('#postBody').val(postBody);

      // submit the form
      $('#post-form').submit();
    });

    $(document).on('click', '#editUserTrigger', function() {
      const userId = $(this).data('id');
      const userName = $(this).data('name');
      const userRole = $(this).data('role'); //isAdmin: true or false
      const userPlan = $(this).data('plan');

      $('#edit_name').val(userName);
      $('#userId').val(userId);

      var options = $('#edit_plan').find('option');

      if(options.length == 0) {
        // create new option element
        var opt = document.createElement('option');
        // create text node to add to option element (opt)
        opt.appendChild( document.createTextNode(userPlan) );
        // set value property of opt
        opt.value = userPlan;
        opt.selected = true;
        $('#edit_plan')[0].add(opt);

        var opt2 = document.createElement('option');
        // create text node to add to option element (opt)

        var userPlan2 = userPlan == 'premium' ? 'Free' : 'Premium';
        opt2.value = userPlan == 'premium' ? 'free' : 'premium';
        opt2.appendChild( document.createTextNode(userPlan2) );
        
        $('#edit_plan')[0].add(opt2);
      } else {
        $('#edit_plan').val(userPlan);
      }



      var options2 = $('#edit_role').find('option');

      if(options2.length == 0) {
        // create new option element
        var opt3 = document.createElement('option');
        // create text node to add to option element (opt)
        var userRoleText = userRole ? 'Admin' : 'User';
        opt3.appendChild( document.createTextNode(userRoleText) );
        // set value property of opt
        opt3.value = userRole ? 'true' : 'false';
        opt3.selected = true;
        $('#edit_role')[0].add(opt3);

        var opt4 = document.createElement('option');
        // create text node to add to option element (opt)

        var userRole2 = userRole === '' ? 'Admin' : 'User';
        opt4.value = userRole2 == 'Admin' ? true : false;
        opt4.appendChild( document.createTextNode(userRole2) );
        
        $('#edit_role')[0].add(opt4);
      } else {
        var selectedValue = userRole == true ? 'true' : 'false';
        $('#edit_role').val(selectedValue);
      }
    })

})