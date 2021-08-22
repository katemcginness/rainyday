document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.sidenav');
    var instances = M.Sidenav.init(elems, {});
    var el = document.querySelectorAll('.tabs');
    var instance = M.Tabs.init(el, {});
    var elems = document.querySelectorAll('select');
    var instances = M.FormSelect.init(elems, {});
    var elems = document.querySelectorAll('.modal');
    var instances = M.Modal.init(elems, {});
    var instance = M.Modal.getInstance(elem);
  });
  
