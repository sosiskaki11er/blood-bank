import React from 'react'
import HomeIcon from '../assets/icons/home.svg' 
import ClockIcon from '../assets/icons/clock-plus.svg'
import HeartIcon from '../assets/icons/file-heart-03.svg'
import MessageIcon from '../assets/icons/message-notification-square.svg'
import SettingIcon from '../assets/icons/settings-02.svg'
import LogoutIcon from '../assets/icons/log-out-01.svg'
import DonationIcon from '../assets/icons/heart-circle.svg'
import PlusIcon from '../assets/icons/plus-circle.svg'

function SideBar({subpage, handleSubpage,role,setLogout}) {
  return (
    <div className='sidebar'>
      <div className='container flex-col gap-[48px]'>
        <div className='container flex-col gap-[16px]'>
          {
            role === 'donor' && <h2>Hello, Donor!</h2>
          }
          {
            role === 'patient' && <h2>Hi, Patient!</h2>
          }
          {
            role === 'doctor' && <h2>Howdy, Doctor!</h2>
          }
          {
            role === 'staff' && <h2>Welcome, Staff!</h2>
          }
          {
            role === 'admin' && <h2>Welcome, Admin!</h2>
          }
          <h4 className='text-sm'>Tech. support:<br/>+998 (90) 123-45-67</h4>
        </div>
        <div className='container flex-col gap-[12px]'>
          <div 
          className={subpage === 'home' ? 'page-tab active': 'page-tab'}
          onClick={() => handleSubpage('home')}
          >
            <img src={HomeIcon} className='page-icon'/>
            <h3>Home</h3>
          </div>

          {
            (role === 'donor') &&
            <div 
            className={subpage === 'donation' ? 'page-tab active': 'page-tab'}
            onClick={() => handleSubpage('donation')}
            >
              <img src={DonationIcon} className='page-icon'/>
              <h3>Make donation</h3>
            </div>
          }

          {
            (role === 'patient') &&
            <div 
            className={subpage === 'schedule' ? 'page-tab active': 'page-tab'}
            onClick={() => handleSubpage('schedule')}
            >
              <img src={ClockIcon} className='page-icon'/>
              <h3>Schedule Appt.</h3>
            </div> 
          }

          {
            (role === 'doctor' || role === 'staff') &&
            <div 
            className={subpage === 'schedule' ? 'page-tab active': 'page-tab'}
            onClick={() => handleSubpage('schedule')}
            >
              <img src={ClockIcon} className='page-icon'/>
              <h3>Appointments</h3>
            </div> 
          }

          {
            (role === 'patient') &&
            <div 
            className={subpage === 'request' ? 'page-tab active': 'page-tab'}
            onClick={() => handleSubpage('request')}
            >
              <img src={HomeIcon} className='page-icon'/>
              <h3>Request blood</h3>
            </div>
          }

          {
            (role === 'admin') && 
            <div 
            className={subpage === 'hospital' ? 'page-tab active': 'page-tab'}
            onClick={() => handleSubpage('hospital')}
            >
              <img src={PlusIcon} className='page-icon'/>
              <h3>Add hospital</h3>
            </div>
          }

          <div 
          className={subpage === 'notifications' ? 'page-tab active': 'page-tab'}
          onClick={() => handleSubpage('notifications')}
          >
            <img src={MessageIcon} className='page-icon'/>
            <h3>Notifications</h3>
          </div>
          <div 
          className={subpage === 'settings' ? 'page-tab active': 'page-tab'}
          onClick={() => handleSubpage('settings')}
          >
            <img src={SettingIcon} className='page-icon'/>
            <h3>Settings</h3>
          </div>
        </div>
      </div>
      <div>
      <div 
          className='page-tab'
          onClick={() => setLogout(true)}
          >
            <img src={LogoutIcon} className='page-icon'/>
            <h3>Log out</h3>
          </div>
      </div>
    </div>
  )
}

export default SideBar