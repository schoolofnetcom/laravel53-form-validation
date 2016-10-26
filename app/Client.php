<?php

namespace App;

use Faker\Provider\cs_CZ\DateTime;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    const ESTADOS_CIVIS = [
        1 => 'Solteiro',
        2 => 'Casado',
        3 => 'Divorciado'
    ];

    const PESSOA_FISICA = 'fisica';
    const PESSOA_JURIDICA = 'juridica';

    protected $fillableGeneral = [
        'nome',
        'documento',
        'email',
        'telefone',
        'inadimplente',
    ];

    protected $fillableFisica = [
        'data_nasc',
        'sexo',
        'estado_civil',
        'deficiencia_fisica'
    ];

    protected $fillableJuridica = [
        'fantasia'
    ];

    public static function getPessoa($value)
    {
        return $value == Client::PESSOA_JURIDICA ? $value : Client::PESSOA_FISICA;
    }

    protected function setFillable()
    {
        if ($this->pessoa == self::PESSOA_FISICA) {
            $this->fillable(array_merge($this->fillableGeneral, $this->fillableFisica));
        } else {
            $this->fillable(array_merge($this->fillableGeneral, $this->fillableJuridica));
        }
    }

    public function fill(array $attributes)
    {
        if (!$this->pessoa) {
            $this->pessoa = self::getPessoa(isset($attributes['pessoa']) ? $attributes['pessoa'] : null);
        }
        $this->setFillable();
        return parent::fill($attributes);
    }

    public function getSexoFormattedAttribute()
    {
        return $this->sexo == 'm' ? 'Masculino' : 'Feminino';
    }

    public function setDocumentoAttribute($value)
    {
        $this->attributes['documento'] = preg_replace('/[^0-9]/', '', $value);
    }

    public function getDocumentoFormattedAttribute()
    {
        $string = $this->documento;

        if (!empty($string)) {
            if (strlen($string) == 11) {
                $string = preg_replace('/(\d{3})(\d{3})(\d{3})(\d{2})/', '$1.$2.$3-$4', $string);
            } else {
                $string = preg_replace('/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/', '$1.$2.$3.$4-$5', $string);
            }
        }

        return $string;
    }

    public function getDataNascFormattedAttribute()
    {
        return $this->pessoa == self::PESSOA_FISICA ? (new \DateTime($this->data_nasc))->format('d/m/Y') : "";
    }

}
