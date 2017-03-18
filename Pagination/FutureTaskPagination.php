<?php

namespace Kanboard\Plugin\TaskBoardDate\Pagination;

use Kanboard\Core\Base;
use Kanboard\Model\TaskModel;

class FutureTaskPagination extends Base
{
    public function getDashboardPaginator($userId)
    {
        $query = $this->taskFinderModel->getUserQuery($userId)
            ->gt(TaskModel::TABLE.'.date_board', time());

        $paginator = $this->paginator
            ->setMax(50)
            ->setOrder(TaskModel::TABLE.'.id')
            ->setFormatter($this->taskListSubtaskAssigneeFormatter->withUserId($userId))
            ->setQuery($query)
            ->calculateOnlyIf($this->request->getStringParam('pagination') === 'future')
            ->setUrl('DashboardController', 'show', array(
                'pagination' => 'future',
                'user_id' => $userId,
            ));

        return $paginator;
    }
}
