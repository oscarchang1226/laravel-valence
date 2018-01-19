<?php

namespace SmithAndAssociates\LaravelValence\Console;

use Illuminate\Console\Command;
use App\Module;
use App\Office;

class ChildlessCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'smithu:childless
    						{--type= : Filter to org units of this type.}
    						{--code= : Filter to org units with codes containing this substring.}
    						{--name= : Filter to org units with names containing this substring.}
    						{--bookmark= : Bookmark to use for fetching next data set segment.}
    						{--A|all : Get all items.}
    						{--S|sync : Sync to this database.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Retrieve all org units that have no children.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
		/**
		 * @var \SmithAndAssociates\LaravelValence\Helper\D2LHelper $d2l
		 */
        $d2l = resolve('D2LHelper');
		$sync = $this->option('sync');
		$params = [
			'orgUnitType' => $this->option('type'),
			'orgUnitCode' => $this->option('code'),
			'orgUnitName' => $this->option('name'),
			'bookmark' => $this->option('bookmark'),
		];
		$result = $d2l->getChildless($params);

		if ($this->option('all')) {
			while ($result['PagingInfo']['HasMoreItems']) {
				$params['bookmark'] = $result['PagingInfo']['Bookmark'];
				$temp = $d2l->getChildless($params);
				$result['PagingInfo'] = $temp['PagingInfo'];
				$result['Items'] = array_merge($result['Items'], $temp['Items']);
			}
		}

		if ($result['PagingInfo']['HasMoreItems']) {
			$this->info('There are more items! Add \'--bookmark '. $result['PagingInfo']['Bookmark'] .'\'');
		}

		foreach($result['Items'] as $i) {
			$name = $i['Name'];
			$code = $i['Code'];
			$id = $i['Identifier'];

			if ($sync) {
				$office = $d2l->getAncestors($id, ['ouTypeId' => 105]);
				if (count($office) > 0) {
					$officeId = Office::where('code', $office[0]['Code'])->first();
					$officeId = $officeId ? $officeId->id : null;
					if ($officeId) {
						$module = Module::firstOrNew(['id' => $id]);
						$module->name = $name;
						$module->office_id = $officeId;
						$module->save();
						$this->info($id . ' ' . $name . ' updated.');
					}
				}
			}

			$this->info($id . ' ' . $name . ' ' . $code);
		}

		return $result;
    }
}
