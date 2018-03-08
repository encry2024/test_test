<?php

namespace App\Http\Controllers\Backend;

# Facades
use Arcanedev\LogViewer\Contracts\LogViewer as LogViewerContract;
use Arcanedev\LogViewer\Entities\LogEntry;
use Arcanedev\LogViewer\Exceptions\LogNotFoundException;
use Arcanedev\LogViewer\Tables\StatsTable;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
# Controllers
use App\Http\Controllers\Controller;
# Models
use App\Models\Todo\Todo;

/**
 * Class DashboardController.
 */
class DashboardController extends Controller
{

    public function __construct(LogViewerContract $logViewer)
    {
        $this->logViewer = $logViewer;
        $this->perPage = config('log-viewer.per-page', 30);
    }
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $date    = date('Y-m-d');
        $log     = $this->getLogOrFail($date);
        $levels  = $this->logViewer->levelsNames();
        $entries = $log->entries($level = 'info')->paginate($this->perPage);
        $todos   = Todo::whereStatus('PENDING')->limit(10)->get();

        return view('backend.dashboard')->withTodos($todos)->withEntries($entries);
    }

    protected function getLogOrFail($date)
    {
        $log = null;

        try {
            $log = $this->logViewer->get($date);
        }
        catch (LogNotFoundException $e) {
            abort(404, $e->getMessage());
        }

        return $log;
    }
}
