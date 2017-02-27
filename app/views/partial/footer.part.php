<?php
resource("js","jquery-3.1.1.min");
resource("js","semantic.min");
?>
<script>
    $.fn.api.settings.api={
        'search':'http://localhost:8080/search?q={value}'
    }
    var content=[];
    $('#search').api({
        action:'search',
        onSuccess:function(response){

            response.forEach(function(r){
                $('.results').append(`<p>${r.title}</p>`);
                content.push({title:r.title});
                console.log(r);
            });
        }
    });
    $('#search').search({
        source: content
    });
</script>
</body>
</html>
