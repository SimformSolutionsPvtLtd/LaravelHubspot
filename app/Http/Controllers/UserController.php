<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\HubspotContact;
use Yajra\DataTables\Datatables;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
  /**
   * This function is used to fetch contact list from hubspot
   */
  public function userList(Request $request)
  {
    try {
      $contacts = collect(getContact());
      $datatablesData = $contacts->map(function ($contact) {
        return [
          'id' => $contact['id'],
          'first_name' => $contact['properties']['firstname'] ?? '',
          'last_name' => $contact['properties']['lastname'] ?? '',
          'email' => $contact['properties']['email'] ?? '',
          'createdate' => $contact['properties']['createdate'] ?? '',
          'lastmodifieddate' => $contact['properties']['lastmodifieddate'] ?? ''
        ];
      });
      if ($request->ajax()) {
        return Datatables::of($datatablesData)->addIndexColumn()
          ->addColumn('edit', function ($row) {
            $btn = '<a href="update-user/" class="btn btn-warning btn-sm" role="button">EDIT</a>';
            return $btn;
          })
          ->addColumn('delete', function ($row) {
            $btn = '<a href="delete-user/' . $row["id"] . '" class="btn btn-danger btn-sm" role="button">DELETE</a>';
            return $btn;
          })
          ->rawColumns(['edit', 'delete'])
          ->make(true);
      }
    } catch (\Exception $e) {
      echo 'Error : ' . $e->getMessage();
    }
  }

  /**
   * This function is used to display user details for edit
   *
   */
  public function updateUser()
  {
    return view('update_user', ['user' => auth()->user()]);
  }

  /**
   * This function is used to save user details after update
   *
   */
  public function saveUpdateUser(Request $request)
  {
    try {
      $user = User::find(auth()->user()->id);
      updateContact($request->all());
      $data = $user->update(['name' => $request->name, 'email' => $request->email, 'password' => Hash::make($request->password)]);
      if ($data) {
        return redirect('/home')->with('message', 'Update User Successfully');
      } else {
        return redirect()->back()->with('error', 'User Not Found');
      }
    } catch (\Exception $e) {
      return redirect()->back()->with('error', 'Something went wrong');
    }
  }

  /**
   * Delete User From Hubspot As well From Database
   *
   */
  public function deleteUser($id)
  {
    try {
      $userId = HubspotContact::where('hubspot_contact_id', $id)->pluck('user_id')->first();
      $delete = false;
      if ($userId) {

        if ($userId == auth()->user()->id) {
          // User is not authorized to delete the record
          abort(403, 'Unauthorized action.');
        }
        $user = User::find($userId);
        //Delete User Form Database
        $delete = $user->delete();
      }
      //Delete Hubspot Contact
      $delete = deleteContact($id);
      if ($delete) {
        return redirect('/home')->with('message', 'User Deleted Successfully');
      } else {
        return back()->with('error', 'User Not Deleted');
      }
    } catch (\Exception $e) {
      return redirect('/home')->with('error', 'Something Went Wrong');
    }
  }
  /**
   * This function is used to get the list of contact from hubspot
   *
   */
  public function hubspotUser()
  {
    $hubspotUser = getContact();
    if ($hubspotUser) {
      return view('user.hubspot-user', ['hubspotUser' => $hubspotUser]);
    } else {
      return back()->with('error', 'No User Found In Hubspot');
    }
  }

  /**
   * This function is used to display signup form for contact
   *
   */
  public function signupUser()
  {
    return view('singup_news');
  }
}
