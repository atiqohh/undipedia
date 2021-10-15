<?
function recent_posts($no_posts = 10, $excerpts = true) {

   global $wpdb;

   $request = "SELECT judul FROM $wpdb->post  ORDER BY post_date DESC LIMIT $no_posts";

   $posts = $wpdb->get_results($request);

   if($posts) {

               foreach ($post as $post) {
                       $judul = stripslashes($post->judul);
                       $permalink = get_permalink($posts->idpost);

                       $output .= '<li><h2><a href="' . $permalink . '" rel="bookmark" title="Permanent Link: ' . htmlspecialchars($post_title, ENT_COMPAT) . '">' . htmlspecialchars($post_title) . '</a></h2>';

                       if($excerpts) {
                               $output.= '<br />' . stripslashes($posts->post_excerpt);
                       }

                       $output .= '</li>';
               }

       } else {
               $output .= '<li>No posts found</li>';
       }

   echo $output;
}
?>