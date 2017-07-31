<?php
namespace App\Bls\Admin\Category\Model;

use App\Bls\Admin\Page\Model\PageModel;
use Illuminate\Database\Eloquent\Model;

/**
 * 导航数据模型
 */
class CategoryModel extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'category';

    /**
     * 页面关联。
     */
    public function relationPage()
    {
        return $this->belongsTo(PageModel::class, 'page_id');
    }

}