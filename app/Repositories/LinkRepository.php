<?php

namespace App\Repositories;

use App\Models\Link;
use Illuminate\Http\Request;
use App\Repositories\RepositoryAbstract;
use App\Repositories\Interfaces\RepositoryInterface;

class LinkRepository extends RepositoryAbstract implements RepositoryInterface
{   
    /**
     * Initiate Link Repository
     * @param Link $link
     */
    public function __construct(Link $link)
    {
        $this->model = $link;
    }

    /**
     * Return all records of active shortened links
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->model->where('enable', true)->get();
    }

    /**
     * Store shortened links
     * @param Request $request
     * @return \App\Models\Link
     */
    public function store(Request $request)
    {   
        $request->validate($this->model->rules(), $this->model->feedback());
        $data = $request->all();
        if(!isset($data['hash'])) {
            $data['hash'] = $this->generateHash($data['url']);
            $link = $this->checkIfLinkExists($data['hash']);
            if($link) {
                $this->checkExpirationDate($link);
                return $link;
            }
            $data['shortened_link'] = env('APP_URL') .'/'. $data['hash'];
        }
        
        return $this->model->create($data);
    }

    /**
     * Shows a specific link
     * @param mixed $id
     * @return \App\Models\Link
     */
    public function show($id)
    {
        return $this->model
        ->where('id', $id)
        ->where('enable', true)
        ->first();
    }

    /**
     * Disables a link
     * @param Request $data
     * @param mixed $id
     * @return void
     */
    public function update(Request $data, $id)
    {
        return $this->disableLink($id);
    }

    public function destroy($id)
    {
    }

    /**
     * Generates a hash to short the link
     * @param mixed $input
     * @return string
     */
    protected function generateHash($input) 
    {
        return substr(strtolower(preg_replace('/[0-9_\/]+/', '', base64_encode(sha1($input)))), 0, 8);
    }


    /**
     * Checks if a link exists based on his hash
     * @param mixed $hash
     * @return Link|bool
     */
    protected function checkIfLinkExists($hash) 
    {
        $link = $this->model::where(['hash' => $hash])->first();
        if($link) {
            return $this->checkExpirationDate($link);
        }

        return false;
    }

    /**
     * Checks if a link still under expiration date
     * @param Link $link
     * @return Link|int
     */
    protected function checkExpirationDate(Link $link) {
        $updatedAt = new \DateTime($link['updated_at']);
        $date = new \DateTime();
        $dateInterval = $updatedAt->diff($date);
        if(!$link['enable'] && $dateInterval->days > 7) {
            return $this->enableLink($link->id);
        }

        return $link;
    }

    /**
     * Enables a link
     * @param mixed $id
     * @return int
     */
    protected function enableLink($id): int
    {
        return $this->model->where('id', $id)->update(['enable' => true]);
    }

    /**
     * Disables a link
     * @param mixed $id
     * @return mixed
     */
    protected function disableLink($id) {
        return $this->model
        ->where('id', $id)
        ->update(['enable'=> false]);
    }
}