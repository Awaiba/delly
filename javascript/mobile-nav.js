// Toggle mobile navigation: adds/removes `mobile-nav-open` on <body>
(function(){
    function toggleNav(e){
        e && e.preventDefault();
        document.body.classList.toggle('mobile-nav-open');
    }

    function init(){
        var btn = document.getElementById('mobile-nav-toggle');
        if(!btn) return;
        btn.addEventListener('click', toggleNav, false);

        // close when clicking outside the navbar-menu on small screens
        document.addEventListener('click', function(e){
            if(!document.body.classList.contains('mobile-nav-open')) return;
            var menu = document.querySelector('.navbar-menu');
            if(!menu) return;
            if(menu.contains(e.target) || btn.contains(e.target)) return;
            document.body.classList.remove('mobile-nav-open');
        }, false);
    }

    if(document.readyState === 'loading') document.addEventListener('DOMContentLoaded', init);
    else init();
})();
