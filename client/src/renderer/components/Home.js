import React from 'react'
import Banner from './Banner'
import Appointments from './Appointments'
import Medinfo from './Medinfo'
import History from './History'
import Requests from './Requests'
import BloodAvailable from './BloodAvailable'
import UserTable from './UserTable'
import Schedule from './Schedule'

function Home({subpage, handleSubpage,role}) {
  console.log(role)
  return (
    <div className='subpage'>
        <Banner/>
        {(role === 'staff') && <BloodAvailable role={role}/>}
        {(role !== 'admin' && role !== 'doctor' && role !== 'staff') && <Appointments handleSubpage={handleSubpage} role={role} subpage={subpage}/>}
        {(role === 'doctor') && <BloodAvailable role={role}/>}
    </div>
  )
}

export default Home