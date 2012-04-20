<?php
/**
 * Provides a convenient class for handling standard pagination variables.
 * 
 * @author: Bill Bushey<wbushey@acm.org>
 * Last Updated: 7/29/08
 */

class Pagination{
    
    public $total_results;                  // Total number of results returned
    public $prv_page;                       // Link to previous page of results
    public $next_page;                      // Link to next page of results
    public $total_pages;                    // Total number of pages
    public $pg_listings = array();          // List of links to specific page numbers
    public $limit;                          // Number of results to display per page
    public $cur_page;                       // Current page number
    
    /**
     * Sets the total_pages variable and does a check on the cur_page variable.
     * 
     * The variables limit and total_results must be set before this method is called.
     * If these variables are not set then 0 will be returned and nothing will be set.
     *
     * @return 0 if nothing is set, true if successful
     */
    public function set_total_pages(){
        if (!isset($this->limit) || !isset($this->total_results)) return 0;
        $this->total_pages = ceil($this->total_results / $this->limit);
        
        if (is_null($this->cur_page) || !is_numeric($this->cur_page)
                || $this->cur_page < 1 || $this->cur_page > $this->total_pages) 
            $this->cur_page = 1;
        if ($this->cur_page > $this->total_pages) $this->cur_page = $this->total_pages;
        if ($this->cur_page <= 0) $this->cur_page = 1;
        
        return true;
    }
    
    /**
     * Creates the prv_page and next_page variables, as well as the pg_listings array.
     * 
     * The variables cur_page and total_pages must be set before this method is called.
     * If these variables are not set then 0 will be returned and nothing will be set.
     *
     * @param boris_View $view
     * @return 0 if nothing is set, true if successful
     */
    public function set_links(boris_View $view){
        if (!isset($this->cur_page) || !isset($this->total_pages)) return 0;
        
        // Set the next and previous links
        // Sorry this isn't more legible :\
        $this->prv_page = $this->cur_page - 1;
        $this->prv_page = (($this->prv_page < 1) ? "" : "<a href=\"{$view->getAugViewUrl(array('p' => $this->prv_page, 'l' => $this->limit))}\">Previous</a>");
        $this->next_page = $this->cur_page + 1;
        $this->next_page = (($this->next_page > $this->total_pages) ? "" : "<a href=\"{$view->getAugViewUrl(array('p' => $this->next_page, 'l' => $this->limit))}\">Next</a>");
        
        // Set the page listing
        $left = ($this->cur_page > 5) ? $this->cur_page - 5 : 1;
        $right = ($this->cur_page < $this->total_pages - 5) ? $this->cur_page + 5 : $this->total_pages;
        if ($left > 1) $this->pg_listings[] = "...";
        for ($i = $left; $i <= $right; ++$i){
            $this->pg_listings[] = ($i == $this->cur_page) ? $i : "<a href=\"{$view->getAugViewUrl(array('p' => $i, 'l' => $this->limit))}\">$i</a>";
        }
        if ($right < $this->total_pages) $this->pg_listings[] = "...";
        
        return true;
    }
}

?>