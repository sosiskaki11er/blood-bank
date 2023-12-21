import React, { useEffect, useState } from 'react'
import Appointments from './Appointments'
import { Socket } from '..'

function Schedule({role,HandleSubpage, subpage}) {
  const user = JSON.parse(localStorage.getItem("user"))
  console.log(user)
  const [date, setDate] = useState('')
  const [time, setTime] = useState('')
  const [hospital, setHospital] = useState('')
  const [hospitals,setHospitals] = useState([])
  const [doctors, setDoctors] = useState([])
  const [doctor, setDoctor] = useState()
  const [donationType, setDonationType] = useState(0)
  console.log(role)

  const HandleDonationType = (type) => {
    setDonationType(type)
  }

  useEffect(()=> {
    if(role === 'patient' || role === 'donor'){
        setTimeout(() => {
            Socket.request("GET","hospital","showAll","").then(data => {setHospitals(data.data);setHospital(data.data[0].guid)})
        },10)
    }
    },[])

  useEffect(() => {
    if(role === 'patient' || role === 'donor'){
        setTimeout(() => {
        Socket.request("GET","doctor","index","").then(data => {setDoctors(data.data);setDoctor(data.data[0].guid)})
        },200)
    }

    },[])

  const HandleSubmit = () => {
    switch(role){
        case "donor":
            if(date && time && hospital && doctor && donationType){
                Socket.request("POST",role,"transfusion/create",`?date=${date}&time=${time.replaceAll(':',';')}&hospital_guid=${hospital}&type=${donationType}:${user.token}`)
            }
        case "patient":
            if(date && time && hospital && doctor){
                Socket.request("POST",role,"infusion/create",`?date=${date}&time=${time.replaceAll(':',';')}&hospital_guid=${hospital}&doctor_guid=${doctor}:${user.token}`)
                .catch(error => alert("Appointment cannot be scheduled to the past date"))
            }
    }

  }
  return (
    <div className='subpage'>
      <Appointments role={role} handleSubpage={HandleSubpage}/>
      {
        (role === 'patient' || role === 'donor') &&
        <div className='component max-w-[684px]'>
            <h3>Schedule appointment</h3>
            <div className='container flex-col gap-[24px]'>
                    <div className='flex gap-[20px]'>
                        <div className='container flex-grow-[1] flex-col max-w-[332px]'>
                            <h4 className='input-header'>Date of appointment*</h4>
                            <input type='date' value={date} onChange={(e) => setDate(e.target.value)}/>
                        </div>
                        <div className='container flex-grow-[1] flex-col max-w-[332px]'>
                            <h4 className='input-header'>Time of appointment*</h4>
                            <input type='time' value={time} onChange={(e) => setTime(e.target.value)}/>
                        </div>
                    </div>
                    <div className='flex gap-[20px]'>
                        <div className='container flex-grow-[1] flex-col'>
                            <h4 className='input-header'>Hospital*</h4>
                            <select type='text' onChange={(e) => setHospital(e.target.value)} value={hospital}>
                                {
                                    hospitals.map(hospital => <option key={hospital.guid} value={hospital.guid}>{hospital.name}</option>)
                                }
                            </select>
                        </div>
                        {
                            (role === 'patient' || role === 'donor') &&
                            <div className='container flex-grow-[1] flex-col max-w-[332px]'>
                                <h4 className='input-header'>Doctor’s Name*</h4>
                                <select type='text' onChange={(e) => setDoctor(e.target.value)} value={doctor}>
                                    {
                                        doctors.map(doctor => <option key={doctor.guid} value={doctor.guid}>{`${doctor.name} ${doctor.surname}`}</option>)
                                    }
                                </select>
                            </div>
                        }
                    </div>
                        {
                            (role === 'donor') &&
                            <div className='container flex-col gap-[16px]'>
                                <h4 className='input-header'>Choose donation type:</h4>
                                <div className="container gap-[8px] flex-wrap">
                                    <div className={donationType === 1 ? "role-tab active w-[196px]" : "role-tab w-[196px]"} onClick={(e) => HandleDonationType(1)}>Charity</div>
                                    <div className={donationType === 2 ? "role-tab active w-[196px]" : "role-tab w-[196px]"} onClick={(e) => HandleDonationType(2)}>Paid</div>
                                </div>
                            </div> 
                        }
                    <button onClick={() => HandleSubmit()}>Submit</button>
                </div>      
        </div>
      }

    </div>
  )
}

export default Schedule