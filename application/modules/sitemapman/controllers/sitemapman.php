<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class sitemapman extends MX_Controller 
{
 
function __construct()
    {
        parent::__construct();

		$this->load->model("sitemapman_mdl");
		$this->load->helper("url");
		$this->load->helper('download');
		
    } 

public function gen_sitemap($lang_id)
{
	if($lang_id ==2)
	{
		$xml = $this->sitemap_en();
    	force_download('sitemap_en.xml', $xml);
	}
	
	if($lang_id ==1)
	{
		$xml = $this->sitemap_tr();
    	force_download('sitemap_tr.xml', $xml);
	}
    
    
}

 
public function sitemap_en()
{
	$categories_localizedid = $this->sitemapman_mdl->get_categories_localizedid(2); // 2 for english not german or french ...etc
	
		
	$xml = '<?xml version="1.0" encoding="UTF-8"?>
	<urlset
    xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
    xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
    xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
    http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
	
	<url>
		<loc>'.base_url().'</loc>
		<changefreq>daily</changefreq>
	</url>
	<url>
		<loc>'.base_url().'brands/brands_list</loc>
		<changefreq>daily</changefreq>
	</url>
	<url>
		<loc>'.base_url().'about</loc>
		<changefreq>daily</changefreq>
	</url>
	<url>
		<loc>'.base_url().'about/contact</loc>
		<changefreq>daily</changefreq>
	</url>
	<url>
		<loc>'.base_url().'login</loc>
		<changefreq>daily</changefreq>
	</url>
	<url>
		<loc>'.base_url().'about/returns</loc>
		<changefreq>daily</changefreq>
	</url>
	<url>
		<loc>'.base_url().'about/shipping</loc>
		<changefreq>daily</changefreq>
	</url>
	';
	
	foreach($categories_localizedid as $category_localizedid)
	{
	$xml .= '<url>
		<loc>'.base_url().$category_localizedid->localizedId.'</loc>
		<changefreq>daily</changefreq>
	</url>
	';
	}
		
	$xml .= '</urlset>';
		
	//var_dump($categories_localizedid);
	
	//echo $xml;

	return $xml;	

   
}


 
public function sitemap_tr()
{
	$links_rewrite = $this->sitemapman_mdl->get_categories_link_rewrite(1); // 1 for Turkish not german or french ...etc
	
		
	$xml = '<?xml version="1.0" encoding="UTF-8"?>
	<urlset
    xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
    xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
    xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
    http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
	
	<url>
		<loc>'.base_url().'</loc>
		<changefreq>daily</changefreq>
	</url>
	<url>
		<loc>'.base_url().'brands/brands_list</loc>
		<changefreq>daily</changefreq>
	</url>
	<url>
		<loc>'.base_url().'about</loc>
		<changefreq>daily</changefreq>
	</url>
	<url>
		<loc>'.base_url().'about/contact</loc>
		<changefreq>daily</changefreq>
	</url>
	<url>
		<loc>'.base_url().'login</loc>
		<changefreq>daily</changefreq>
	</url>
	<url>
		<loc>'.base_url().'about/returns</loc>
		<changefreq>daily</changefreq>
	</url>
	<url>
		<loc>'.base_url().'about/shipping</loc>
		<changefreq>daily</changefreq>
	</url>
	';
	
	foreach($links_rewrite as $link_rewrite)
	{
	$xml .= '<url>
		<loc>'.base_url().$link_rewrite->link_rewrite.'</loc>
		<changefreq>daily</changefreq>
	</url>
	';
	}
		
	$xml .= '</urlset>';
		
	return $xml;	
   
}



public function generate_routes($land_id)
{
	if($land_id == 1)
	{
		$code_output = $this->generate_routes_tr();
		force_download("code_output_tr.php", $code_output);
		
	}
	if($land_id == 2)
	{
		$code_output = $this->generate_routes_en();
		force_download("code_output_en.php", $code_output);
	}
	
	
}

public function generate_routes_en()
{
	$categories_localizedid = $this->sitemapman_mdl->get_categories_localizedid(2); // 2 for english not german or french ...etc
	
	
	$output = '';
	
	foreach($categories_localizedid as $category_localizedid)
	{
	
		$cat_localizedid = $category_localizedid->localizedId;
		$cat_id = $category_localizedid->id_category;
		
		//$route['women'] = 'router/category/2';
		$output .= '$route["'.$cat_localizedid.'"] = "router/category/'.$cat_id.'" ; '."\n" ;
	}
	
	return $output;
	
	/*$this->load->helper('download');
    $name = 'route_code.php';

    force_download($name, $output);*/
    
}


public function generate_routes_tr()
{
	$categories_link_rewrite = $this->sitemapman_mdl->get_categories_link_rewrite(1); // 1 for turkish not german or french ...etc
	
	
	$output = '';
	
	foreach($categories_link_rewrite as $category_link_rewrite)
	{
	
		$link_rewrite = $category_link_rewrite->link_rewrite;
		$cat_id = $category_link_rewrite->id_category;
		
		//$route['women'] = 'router/category/2';
		$output .= '$route["'.$link_rewrite.'"] = "router/category/'.$cat_id.'" ; '."\n" ;
	}
	
    return $output;
    
    //$name = 'route_code.php';
    //force_download($name, $output);
    
}

    
}

/* End of file sitemap.php */
/* Location: ./application/modules/sitemap/controllers/sitemap.php */