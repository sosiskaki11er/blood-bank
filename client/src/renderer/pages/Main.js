import React, { useEffect, useState } from 'react'
import SideBar from '../components/SideBar'
import {useSearchParams} from 'react-router-dom'
import Home from '../components/Home';
import Schedule from '../components/Schedule';
import Notifications from '../components/Notifications';
import Settings from '../components/Settings';
import Request from '../components/Request';
import Donation from '../components/Donation';
import Logout from '../components/Logout';
import Requests from '../components/Requests';
import Prescriptions from '../components/Prescriptions';
import EditPrescription from '../components/EditPrescription';
import AddHospital from '../components/AddHospital';

function Main() {
  const [searchParams, setSearchParams] = useSearchParams();
  const role=searchParams.get('role')
  const [subpage, setSubpage] = useState(searchParams.get('page'))
  const [logout, setLogout] = useState(false)

  const HandleSubpage = (page) => {
    setSubpage(page)
  }
  return (
    <div className='container'>
        <SideBar role={role} subpage={subpage} handleSubpage={HandleSubpage} setLogout={setLogout}/>
        {
          (subpage === 'home') && <Home subpage={subpage} handleSubpage={HandleSubpage} role={role}/>
        }
                {
          (subpage === 'schedule') && <Schedule role={role} subpage={subpage} HandleSubpage={HandleSubpage}/>
        }
                {
          (subpage === 'request') && <Request/>
        }
                {
          (subpage === 'notifications') && <Notifications/>
        }
                {
          (subpage === 'settings') && <Settings/>
        }
        {
          (subpage === 'donation') && <Schedule role={role}/>
        }
        {
          (subpage === 'prescriptions') && <Prescriptions setSubpage={setSubpage}/>
        }
        {
          (subpage === 'edit-prescription') && <EditPrescription setSubpage={setSubpage} subpage={subpage} role={role}/>
        }
        {
          (subpage === 'hospital') && <AddHospital role={role}/>
        }
        {
          logout && <Logout role={role} setLogout={setLogout}/>
        }
    </div>
  )
}

export default Main