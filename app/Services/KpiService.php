<?php

namespace App\Services;


use App\Repositories\KpiDataPointRepository;
use App\Repositories\KPIRespository;
//use App\Services\Contracts\KpiServiceInterface;
use App\Validators\KpiDataValidator;
use App\Validators\KpiValidator;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class KpiService //implements KpiServiceInterface
{
    protected $kpiRepo;
    protected $kpiDataRepo;
    public function __construct(KPIRespository $KPIRespository,KpiDataPointRepository $kpiDataPointRepository)
    {
        $this->kpiRepo=$KPIRespository;
        $this->kpiDataRepo=$kpiDataPointRepository;
    }

    public function index($project, $organization = null)
    {
//        $project=arrayValue($data,'project');
//        $organization=arrayValue($data,'organization');

        $query=$this->kpiRepo->allKpi($project, $organization);

        if($query){
            return renderCollection($query);
        }
        else{
            throw new \Exception( "Kpis not found");
        }
    }

    public function show($kpi_id)
    {
        if(empty($kpi_id)){
            throw new \Exception("Invalid kpi selection");
        }

        $query=$this->kpiRepo->with(['project','data'])->find($kpi_id);
        if($query){
            $data['id']=$query['id'];
            $data['title']=$query['title'];
            $data['x_label']=$query['x_label'];
            $data['y_label']=$query['y_label'];
            $data['start_date']=$query['end_date'];
            $data['end_date']=$query['start_date'];
            $data['project_id']=isset($query['project']['id']) ?  $query['project']['id'] : null;
            $data['project_name']=isset($query['project']['id']) ?  $query['project']['name'] : null;
            $data['project_start']=isset($query['project']['id']) ?  $query['project']['end_date'] : null;
            $data['project_end']=isset($query['project']['id']) ?  $query['project']['start_date'] : null;
            $data['points']=isset($query['kpiData']) ? $query['kpiData'] : null ;
            $data['created_at']=Carbon::parse($query['created_at'])->format('Y-m-d H:i:s');

            return $data;
        }
        else{
            throw new \Exception("Kpi not found");
        }

    }

    public function create($data)
    {
        $validator=new KpiValidator($data,'create');
        if($validator->fails()){
            throw new \Exception($validator->messages()->first());
        }

        $data['start_date'] = date('Y-m-d', strtotime( $data['start_date']));
        $data['end_date'] = date('Y-m-d', strtotime( $data['end_date']));

        $query=$this->kpiRepo->create($data);

        if($query){
             return $query;
        }
        else{
            throw new \Exception(config('messages.common_error'));
        }

    }

    public function update($data, $kpi_id)
    {
        if(empty($kpi_id)){
            throw new \Exception("Invalid kpi selection");
        }

        $data['start_date'] = date('Y-m-d', strtotime( $data['start_date']));
        $data['end_date'] = date('Y-m-d', strtotime( $data['end_date']));

        $query=$this->kpiRepo->update($kpi_id,$data);

        if($query){
            return $query;
        }
        else{
            throw new \Exception(config('messages.common_error'));
        }

    }

    public function delete($kpi_id)
    {
        if(empty($kpi_id)){
            throw new \Exception("kpi_id is required");
        }

        DB::beginTransaction();
        $kpi=$this->kpiRepo->find($kpi_id);
        if($kpi){
            $query=$this->kpiRepo->deleteRecord($kpi);
            if($query){
                DB::commit();
                return;
            }
            else{
                DB::rollBack();
                throw new \Exception(config('messages.common_error'));
            }
        }
        else{
            DB::rollBack();
            throw new \Exception("Kpi point not found");
        }

    }

    public function addDataPoint($data)
    {
        $validator=new KpiDataValidator($data,'create');
        if($validator->fails()){
            throw new \Exception($validator->messages()->first());
        }

        $query=$this->kpiDataRepo->create($data);
        if($query){
            return;
        }
        else{
            throw new \Exception(config('messages.common_error'));
        }

    }

    public function updateDataPoint($data, $id)
    {
        $validator=new KpiDataValidator($data,'create');
        if($validator->fails()){
            throw new \Exception($validator->messages()->first());
        }

        $query=$this->kpiDataRepo->update($id, $data);
        if($query){
            return $query;
        }
        else{
            throw new \Exception(config('messages.common_error'));
        }

    }

    public function filterDataPoint($data)
    {
        $start=arrayValue($data,'start');
        $end=arrayValue($data,'end');
        $kpi_id=arrayValue($data,'kpi_chart_id');

        if(empty($start) || empty($end)){
            throw new \Exception("Please enter valid date range");
        }

        if(empty($kpi_id)){
            throw new \Exception("kpi_id is required");
        }

        $query=$this->kpiDataRepo->filterDataPoint(Carbon::parse($start)->format('Y-m-d'),Carbon::parse($end)->format('Y-m-d'),$kpi_id);
        if(count($query) > 0){
            return $query;
        }
        else{
            throw new \Exception("No datapoint available");
        }

    }

    public function deleteDatapoint($point_id)
    {
        if(empty($point_id)){
            throw new \Exception("Invalid datapoint selection");
        }

        DB::beginTransaction();
        $point=$this->kpiDataRepo->find($point_id);
        if($point){
            $query=$this->kpiDataRepo->deleteRecord($point);
            if($query){
                DB::commit();
                return;
            }
            else{
                DB::rollBack();
                throw new \Exception(config('messages.common_error'));
            }
        }
        else{
            DB::rollBack();
            throw new \Exception("Data point not found");
        }

    }
}