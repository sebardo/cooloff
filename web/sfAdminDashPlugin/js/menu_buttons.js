document.observe('dom:loaded', function() {
  if ($$('.sf_admin_action_save_and_add').size() == 0) {
    $$('.sf_admin_action_save').each(function(b) {
      b.addClassName('boto1');
    }); 
  }
  
  if ($$('.sf_admin_action_save_and_add').size() == 0) {
    $$('.sf_admin_action_list').each(function(b) {
      b.addClassName('boto2');
    }); 
  }
});
