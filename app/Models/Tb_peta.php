<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tb_peta extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];
    protected $dates = ['deleted_at'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'kab_kota', 'alamat', 'latitude', 'longitude',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    public $appends = [
        'coordinate', 'map_popup_content',
    ];

    /**
     * Get outlet name_link attribute.
     *
     * @return string
     */

    public function wilayah()
    {
        return $this->belongsTo(Tb_wilayah::class, 'id_wilayah');
    }

    public function getNameLinkAttribute()
    {
        $title = __('app.show_detail_title', [
            'name' => $this->kab_kota, 'type' => __('outlet.outlet'),
        ]);
        $link = '<a href="' . route('peta.show', $this) . '"';
        $link .= ' title="' . $title . '">';
        $link .= $this->name;
        $link .= '</a>';

        return $link;
    }

    /**
     * Outlet belongs to User model relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

    /**
     * Get outlet coordinate attribute.
     *
     * @return string|null
     */
    public function getCoordinateAttribute()
    {
        if ($this->latitude && $this->longitude) {
            return $this->latitude . ', ' . $this->longitude;
        }
    }

    /**
     * Get outlet map_popup_content attribute.
     *
     * @return string
     */
    public function getMapPopupContentAttribute()
    {
        $mapPopupContent = '';
        $mapPopupContent .= '<div class="my-2"><strong>' . __('Wilayah') . ':</strong><br>' . $this->wilayah->nama_wilayah . '</div>';
        $mapPopupContent .= '<div class="my-2"><strong>' . __('Koordinat') . ':</strong><br>' . $this->coordinate . '</div>';
        $mapPopupContent .= '<div class="my-2" style="text-align: right;"><a href="/geoportal/' . $this->id . '" >Lihat Detail</a></div>';

        return $mapPopupContent;
    }
}
