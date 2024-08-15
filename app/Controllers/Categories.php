<?php

namespace App\Controllers;

use App\Models\CategoriesModel;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\HTTP\ResponseInterface;
use Config\MyFunctions as ConfigMyFunctions;
use Config\Services;
use Exception;
use MongoDB\BSON\ObjectId;

class Categories extends BaseController
{
    public function index()
    {
        // Reserved
    }

    public function getCategory($category_id): ?array
    {
        $model = new CategoriesModel();

        return $model->getCategoryByID(new ObjectId($category_id));
    }

    public function viewCategories(): string
    {
        $session = Services::session();

        $user = $session->get('user');
        $user_id = new ObjectId($user['_id']);

        $model = new CategoriesModel();

        $categories = $model->getCategories();

        $data = [
            'categories' => $categories
        ];
        return view('categories', $data);
    }

    public function getAJAXCategory(): ResponseInterface
    {
        $category_id = $this->request->getJsonVar('category_id');
        $model = new CategoriesModel();

        $category_data = $model->getCategoryByID(new ObjectId($category_id));
        return $this->response->setJSON($category_data);
    }

    public function getCategories(): array
    {
        $session = Services::session();

        $user = $session->get('user');
        $user_id = new ObjectId($user['_id']);

        $model = new CategoriesModel();

        return $model->getCategories();
    }

    public function viewCategory($category_id): RedirectResponse
    {
        $session = Services::session();

        $user = $session->get('user');
        $user_id = new ObjectId($user['_id']);

        $model = new CategoriesModel();

        $category_data = $model->getCategoryByID(new ObjectId($category_id));

        if (empty($category_data)) {
            $message = [
                "message" => "Couldn't Retrieve Category Info, Please Try Again."
            ];
            $session->setFlashdata("error", $message);
            return redirect()->back();
        }

        $message = [
            "message" => $session->getFlashdata("success")['message'] ?? "Category Data Retrieved Successfully."
        ];
        $session->setFlashdata("success", $message);
        $session->setTempdata('category_data', $category_data, 3600);

        return redirect()->to("category-profile");
    }

    public function categoryProfile(): string|RedirectResponse
    {
        $session = Services::session();
        $category_data = $session->getTempdata('category_data') ?? array();

        if (empty($category_data)) {
            $message = [
                "message" => "Couldn't Retrieve Category Info, Please Try Again."
            ];
            $session->setFlashdata("error", $message);
            return redirect()->to("categories");
        }

        $data = [
            'category_data' => $category_data
        ];

        $message = [
            "message" => $session->getFlashdata("success")['message'] ?? "Category Data Retrieved Successfully."
        ];
        $session->setFlashdata("success", $message);
//        $session->removeTempdata('patient_data');
        return view('category-profile', $data);
    }

    /**
     * @throws Exception
     */
    public function createCategory(): RedirectResponse
    {
        if ($this->request->is('post')) {
            //Retrieve Submitted Data
            $data = $this->request->getPost();
            $validation = Services::validation();
            $session = Services::session();
            helper(['form']);

            if (!is_null($data)) {
                $validation->setRules([
                    'category_name' => [
                        'rules' => 'required',
                        'label' => 'Category Name',
                        'errors' => [
                            'required' => 'Category Name Field Cannot be Empty.'
                        ]
                    ]
                ]);

                if ($validation->run($data)) {
                    $user_data = $session->get('user');

                    $category_name = $data['category_name'];
                    $category_description = $data['category_description'] ?? "";

                    $category_created_by = new ObjectId($user_data['_id']);

                    $model = new CategoriesModel();

                    //Check if Package Exists.
                    $isCategoryExisting = $model->isCategoryExisting($category_name);

                    if (empty($isCategoryExisting)) {
                        $insertionData = [
                            'category_name' => $category_name,
                            'category_description' => $category_description,
                            'category_created_by' => $category_created_by,
                            'category_created_on' => ConfigMyFunctions::getDate(),
                            'category_deleted_flag' => false,
                            'category_updated_by' => "",
                            'category_updated_on' => "",
                            'category_deleted_by' => "",
                            'category_deleted_on' => ""
                        ];

                        $result = $model->addCategory($insertionData);

                        if (empty($result)) {
                            $message = [
                                "message" => "Couldn't Create Category, Please Try Again."
                            ];
                            $session->setFlashdata("error", $message);
                            $session->setFlashdata('form_data', $data);

                        } else {
                            $message = [
                                "message" => "Category Created Successfully."
                            ];
                            $session->setFlashdata("success", $message);
                        }
                    } else {
                        $message = [
                            "message" => "Category With Similar Name Already Exists."
                        ];
                        $session->setFlashdata("error", $message);
                        $session->setFlashdata('form_data', $data);
                    }
                } else {
                    $_SESSION['validationErrors'] = $validation->getErrors();
                    $message = [
                        "message" => $validation->getErrors()
                    ];
                    $session->setFlashdata("validationErrors", $message);
                    $session->setFlashdata('form_data', $data);
                }
            } else {
                $message = [
                    "message" => "Invalid Form Data."
                ];
                $session->setFlashdata("error", $message);
                $session->setFlashdata('form_data', $data);
            }

        }
        return redirect()->back();

    }

    public function updateCategory(): RedirectResponse
    {
        if ($this->request->is('post')) {
            //Retrieve Submitted Data
            $data = $this->request->getPost();
            $validation = Services::validation();
            $session = Services::session();
            helper(['form']);

            if (!is_null($data)) {
                $validation->setRules([
                    'category_id' => [
                        'rules' => 'required',
                        'label' => 'Category ID',
                        'errors' => [
                            'required' => 'Category ID Field Cannot be Empty.'
                        ]
                    ],
                    'category_name' => [
                        'rules' => 'required',
                        'label' => 'Category Name',
                        'errors' => [
                            'required' => 'Category Name Field Cannot be Empty.'
                        ]
                    ]
                ]);

                if ($validation->run($data)) {
                    $user_data = $session->get('user');

                    $category_id = new ObjectId($data['category_id']);
                    $category_name = $data['category_name'];
                    $category_description = $data['category_description'] ?? "";
                    $category_updated_by = new ObjectId($user_data['_id']);

                    $model = new CategoriesModel();

                    $updateData = [
                        'category_name' => $category_name,
                        'category_description' => $category_description,
                        'category_updated_by' => $category_updated_by,
                        'category_updated_on' => ConfigMyFunctions::getDate(),
                    ];

                    $result = $model->updateCategory($updateData, $category_id);

                    if (empty($result)) {
                        $message = [
                            "message" => "Couldn't Update Category, Please Try Again."
                        ];
                        $session->setFlashdata("error", $message);
                        $session->setFlashdata('form_data', $data);

                    } else {
                        $message = [
                            "message" => "Category Updated Successfully."
                        ];
                        $session->setFlashdata("success", $message);
                        return redirect()->to("/view-category/$category_id");
                    }
                } else {
                    $_SESSION['validationErrors'] = $validation->getErrors();
                    $message = [
                        "message" => $validation->getErrors()
                    ];
                    $session->setFlashdata("validationErrors", $message);
                    $session->setFlashdata('form_data', $data);
                }
            } else {
                $message = [
                    "message" => "Invalid Form Data."
                ];
                $session->setFlashdata("error", $message);
                $session->setFlashdata('form_data', $data);
            }

        }
        return redirect()->back();

    }

    public function deleteCategory(): RedirectResponse
    {
        if ($this->request->is('post')) {
            //Retrieve Submitted Data
            $data = $this->request->getPost();
            $validation = Services::validation();
            $session = Services::session();
            helper(['form']);

            if (!is_null($data)) {
                $validation->setRules([
                    'category_id' => [
                        'rules' => 'required',
                        'label' => 'Category ID',
                        'errors' => [
                            'required' => 'Category ID Field Cannot be Empty.'
                        ]
                    ]
                ]);

                if ($validation->run($data)) {
                    $user_data = $session->get('user');

                    $category_id = new ObjectId($data['category_id']);
                    $category_deleted_by = new ObjectId($user_data['_id']);

                    $model = new CategoriesModel();

                    $updateData = [
                        'category_deleted_flag' => true,
                        'category_deleted_by' => $category_deleted_by,
                        'category_deleted_on' => ConfigMyFunctions::getDate(),
                    ];

                    $result = $model->updateCategory($updateData, $category_id);

                    if (empty($result)) {
                        $message = [
                            "message" => "Couldn't Delete Category, Please Try Again."
                        ];
                        $session->setFlashdata("error", $message);
                        $session->setFlashdata('form_data', $data);

                    } else {
                        $message = [
                            "message" => "Category Deleted Successfully."
                        ];
                        $session->setFlashdata("success", $message);
                        return redirect()->to("categories");
                    }
                } else {
                    $_SESSION['validationErrors'] = $validation->getErrors();
                    $message = [
                        "message" => $validation->getErrors()
                    ];
                    $session->setFlashdata("validationErrors", $message);
                    $session->setFlashdata('form_data', $data);
                }
            } else {
                $message = [
                    "message" => "Invalid Form Data."
                ];
                $session->setFlashdata("error", $message);
                $session->setFlashdata('form_data', $data);
            }

        }
        return redirect()->back();

    }

}