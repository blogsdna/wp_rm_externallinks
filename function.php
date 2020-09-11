<?php 

add_filter( 'the_content', 'remove_allex_links_from_post', 1 );

function remove_allex_links_from_post($content = ''){

    if(!preg_match_all("#<a(.*?)>(.*?)</a>#i",$content,$outbound_links,PREG_SET_ORDER)){		
        return $content;
    }
		
    foreach($outbound_links as $key => $value){
        preg_match("/href\s*=\s*[\'|\"]\s*(.*)\s*[\'|\"]/i",$value[1],$href);	
        if(substr($href[1],0,7)!="http://" || substr($href[1],0,8)!="https://") 
		{ 
			if (mb_strtolower(substr($href[1],0,strlen(get_bloginfo("url")))) == mb_strtolower(get_bloginfo("url")))	unset($outbound_links[$key]);
		} 
	}
					
	foreach($outbound_links as $key => $value){		
        	 $content = str_replace($outbound_links[$key][0],$outbound_links[$key][2],$content);
         }
            
    return $content;
}
?>
